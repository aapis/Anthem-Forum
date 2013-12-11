<?php

	abstract class Request {
		public static function get($key){
			$ret = null;
			$search = $_GET[$key];

			if(isset($search)){
				//sanitize output here
				return $ret;
			}

			return $ret;
		}
	}

?>