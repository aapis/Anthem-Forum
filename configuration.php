<?php

	defined("ANTHEM_EXEC") or die;
	
	abstract class Config {
		public static $db_name = "";
		public static $db_user = "";
		public static $db_password = "";
		public static $db_host = "localhost";
	}

?>