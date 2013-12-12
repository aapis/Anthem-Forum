<?php
	defined("ANTHEM_EXEC") or die;
	
	/**
	 * System Helper: Request
	 *
	 * Safely return query string elements
	 */
	abstract class RequestHelper {
		public static function get($key, $default = null){
			$search = isset($_GET[$key]) ? $_GET[$key] : $default;

			return $search;
		}
	}

?>