<?php

/**
* Database class 
*/
class Database
{
	private $connection;

	private static $_instance;

	public static function getInstance() {
		if ( !self::$_instance ) self::$_instance = new self();

		return self::$_instance;
	}

	private function __construct() {
		// $this->connection = new mysqli( 'localhost' , 'root' , 'qq', 'os' );
		//$this->connection = new mysqli( 'localhost' , 'sozonen_skola' , 'sozonen_skola' , 'sozonen_skola');
		$this->connection = new mysqli( 'localhost' , DB_USER , DB_PASSWORD , DATABASE);
		// $this->connection->query("SET NAMES 'cp1251'");
		$this->connection->query("SET NAMES 'utf8';"); 
		$this->connection->query("SET CHARACTER SET 'utf8';"); 
		$this->connection->query("SET SESSION collation_connection = 'utf8_general_ci';"); 
		
		if ( mysqli_connect_error() )
			throw new Exception("Failed to connect to DB:" . mysqli_connect_error());
	}

	private function __clone () {
	}

	public function getConnection() {
		return $this->connection;
	}

	public function clear($value) {
		if(!$this->connection) throw new Exception("You didn't connect to the DB");
	
		return $this->connection->real_escape_string(trim(strip_tags($value)));
	}
	public static function insert($table = '', $columns = array(), $params = array()) {
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		if($table == '' || count($columns) == 0 || count($params) == 0 && count($columns) != count($params)) return false;
		$part_1 = '';
		$part_2 = '';
		foreach ($columns as $value) {
			if($value == '') continue;
			$part_1 .= $value . ", ";
		}
		foreach($params as $value) {
			if($value == '') {
				$part_2 .= "'', ";
			} else if(is_int($value) || is_float($value)) {
				$part_2 .= "$value, ";
			} else {
				$part_2 .= "'$value', ";
			}
		}
		$part_1 = rtrim($part_1,', ');
		$part_2 = rtrim($part_2,', ');
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $part_1, $part_2);
		$mysqli->query($sql);
		if($mysqli->affected_rows == 0) return false;
		return $mysqli->affected_rows;

	}

	public static function select($table = '', $columns = array(), $where = array()) {
		$db = Database::getInstance();
		$resultArray = array();
		$mysqli = $db->getConnection();
		if($table == '' || count($columns) == 0) return false;
		$part_1 = '';
		$part_2 = '';
		if($columns[0] == '*') {
			$part_1 .= '*';
		} else {
			foreach ($columns as $value) {
				if($value == '') continue;
				$part_1 .= $value . ", ";
			}
			
		}
		foreach($where as $key => $value) {
			if(is_int($value) || is_double($value)) {
				$part_2 .= ' AND ' . $key . " = $value";
			} else {
				$part_2 .= ' AND ' . $key . " = '$value'";
			}
		}
		$part_1 = rtrim($part_1,', ');
		$sql = sprintf("SELECT %s FROM %s WHERE 1 = 1 %s", $part_1, $table, $part_2);
		// print($sql);die;
		$res = $mysqli->query($sql);
		if($res->num_rows) {
			while ($row = $res->fetch_assoc()) {
				$resultArray[] = $row;
			}
		}
		// var_dump($resultArray);
		return $resultArray;
	}


	public static function update($table = '', $params = array(), $where = array()) {
		global $logger;
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		if($table == '' || count($params) == 0 || count($where) == 0 ) return false;
		$part_1 = '';
		$part_2 = '';
		foreach($params as $key => $value) {
			if($value == '') {
				$part_1 .= $key . " = '',";
			} else if(is_int($value)) {
				$part_1 .= $key . " = $value,";
			} else {
				$part_1 .= $key . " = '$value',";
			}
		}
		$part_1 = rtrim($part_1,',');
		foreach($where as $key => $value) {
			if(is_int($value)) {
				$part_2 .= $key . " = $value AND ";
			} else {
				$part_2 .= $key . " = '$value' AND ";
			}
		}
		$part_2 = rtrim($part_2, ' AND ');
		$sql = sprintf("UPDATE {$table} SET {$part_1} WHERE {$part_2}");
		//$logger->log_query($sql, 1);
		//print("<br>UPDATE SQL --- $sql<br>");
		$res = $mysqli->query($sql);
		if($mysqli->affected_rows == 0) return false;
		return $mysqli->affected_rows;
	}
	public static function delete($table = '',$where = array()) {
		global $logger;
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
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
		//$logger->log_query($sql, 1);
		//print("<br>DELETE SQL --- $sql<br>");
		$res = $mysqli->query($sql);
		if($mysqli->affected_rows == 0) return false;
		return true;
	}
}

?>
