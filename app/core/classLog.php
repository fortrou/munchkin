<?php
	/**
	 * dev by fortrou
	 * class Log
	 * query Logs,
	 * error Logs
	 * time Logs
	 *
	 **/
	class Log {
		function __construct() {

		}
		public function log_query($query, $log_type = 1) {
			global $munchkin_db;
			$sql = sprintf("INSERT INTO mnc_logs(log_time, log_value, log_type)
								 VALUES ('%s', '%s', %s)", strtotime('now'), htmlspecialchars($query), $log_type);
			$res = $munchkin_db->query($sql);
		}
	}

?>