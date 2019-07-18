<?php

/**
* Database class 
*/
class Database
{
	private $mysqli;

	private static $instance;

	public static function getInstance() {
		if ( !self::$instance ) self::$instance = new self();

		return self::$instance;
	}

	private function __construct() {
		$this->mysqli = new mysqli( 'localhost', DB_USER, DB_PASSWORD, DATABASE);
		$this->mysqli->query("SET NAMES 'utf8';");
		$this->mysqli->query("SET CHARACTER SET 'utf8';");
		$this->mysqli->query("SET SESSION collation_connection = 'utf8_general_ci';");

		if ( mysqli_connect_error() )
			throw new Exception('Failed to connect to DB:' . mysqli_connect_error());
	}

	private function __clone () {
	}

	public function getConnection() {
		return $this->mysqli;
	}

	public function clear($value) {
		return $this->mysqli->real_escape_string(trim(strip_tags($value)));
	}

	public function prepare_select($query, $params = []) {
        if ($stmt = $this->mysqli->prepare($query)) {
            self::bind_params($stmt, $params);
            if($stmt->execute()) {
                $result_array = self::fetch($stmt);
            }
            $stmt->close();
        }
        return $result_array ?? [];
    }

    public function prepare($query, $params = []) {
        if ($stmt = $this->mysqli->prepare($query)) {
            self::bind_params($stmt, $params);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        return $result ?? false;
    }

    public static function bind_params(mysqli_stmt &$stmt, $params) {
	    $types = '';
	    foreach ($params as $param) {
	        if (is_string($param)) {
	            $types .= 's';
            } elseif (is_int($param)) {
	            $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } else {
	            $types .= 'b';
            }
        }
        $stmt->bind_param($types, ...$params);
    }

    public static function fetch($result)
    {
        $array = [];
        if ($result instanceof mysqli_stmt) {
            $result->store_result();
            $variables = [];
            $data = [];
            $meta = $result->result_metadata();

            while($field = $meta->fetch_field()) {
                $variables[] = &$data[$field->name];
            }

            $result->bind_result(...$variables);
            $i=0;

            while($result->fetch())
            {
                $array[$i] = array();
                foreach($data as $k=>$v)
                    $array[$i][$k] = $v;
                $i++;
            }
        } elseif ($result instanceof mysqli_result) {
            while($row = $result->fetch_assoc())
                $array[] = $row;
        }

        return $array;
    }

	public function insert($table, $data_arr = []) {

		$columns = array_keys($data_arr);
		$values = array_values($data_arr);

		if(count($columns) == 0 || count($values) == 0 && count($columns) != count($values)){
			return false;
		}

		$columns_string = '';
		$values_string = '';

		foreach ($columns as $value) {
			if($value == '') continue;
			$columns_string .= $value . ", ";
		}

		foreach($values as $value) {
			if($value == '') {
				$values_string .= "'', ";
			} else if(is_int($value) || is_float($value)) {
				$values_string .= "$value, ";
			} else {
				$values_string .= "'$value', ";
			}
		}

		$columns_string = rtrim($columns_string,', ');
		$values_string = rtrim($values_string,', ');

		$sql = sprintf(
		    'INSERT INTO %s
             (%s)
             VALUES (%s)',
            $table,
            $columns_string,
            $values_string);
		$this->mysqli->query($sql);

		return $this->mysqli->affected_rows ?: false;
	}

	public function select($table, $columns = ['*'], $where = '', $orderby = []) {
		if(count($columns) == 0) return false;
		$columns_string = '';
		$where_string = '';

		if($columns[0] == '*') {
			$columns_string .= '*';
		} else {
			foreach ($columns as $value) {
				if($value == '') continue;
				$columns_string .= $value . ", ";
			}
		}

		if (true === is_string($where)) {
            $where_string = $where;
        } else if (true === is_array($where)) {
            foreach($where as $key => $value) {
                if(is_int($value) || is_float($value)) {
                    $where_string .= ' AND ' . $key . " = $value";
                } else {
                    $where_string .= ' AND ' . $key . " = '$value'";
                }
            }
        }

		if (!empty($orderby)) {
			$orderby_string = 'ORDER BY ';
			foreach ($orderby as $column => $order) {
				$orderby_string .= "${column} ${order}, ";
			}
		} else $orderby_string = '';

		$columns_string = rtrim($columns_string,', ');
        $orderby_string = rtrim($orderby_string,', ');

		$sql = sprintf(
			'SELECT %s
			 FROM %s
			 WHERE 1 = 1
			 %s
			 %s',
			$columns_string,
			$table,
			$where_string,
			$orderby_string
		);

		$res = $this->mysqli->query($sql);
		if($res->num_rows) {
            $resultArray = self::fetch($res);
		}
		return $resultArray ?? [];
	}

	public function update($table, $params = [], $where = []) {

		if(count($params) == 0 || count($where) == 0 ) return false;
		$part_1 = '';
		$part_2 = '';
		foreach($params as $key => $value) {
			if($value == '') {
				$part_1 .= $key . " = '',";
			} else if(is_int($value) || is_float($value)) {
				$part_1 .= $key . " = $value,";
			} else {
				$part_1 .= $key . " = '$value',";
			}
		}
		$part_1 = rtrim($part_1,',');
		foreach($where as $key => $value) {
			if(is_int($value) || is_float($value)) {
				$part_2 .= $key . " = $value AND ";
			} else {
				$part_2 .= $key . " = '$value' AND ";
			}
		}
		$part_2 = rtrim($part_2, ' AND ');
		$sql = sprintf("UPDATE {$table} SET {$part_1} WHERE {$part_2}");
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows == 0) return false;
		return $this->mysqli->affected_rows;
	}

	public function delete($table = '',$where = []) {
		if($table == '' || count($where) == 0 ) return false;

		$part_1 = '';
		foreach($where as $key => $value) {
			if(is_int($value)) {
				$part_1 .= $key . " = $value AND ";
			} else {
				$part_1 .= $key . " = '$value' AND ";
			}
		}
		$part_1 = rtrim($part_1, ' AND ');
		$sql = "DELETE FROM {$table} WHERE {$part_1}";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows == 0) return false;
		return $this->mysqli->affected_rows;
	}

}