<?php

	defined("ANTHEM_EXEC") or die;

	error_reporting(-1);
	
	define("SITE_PATH", realpath(dirname(__FILE__)).'/');
	define("APP_PATH", BASE . "/app");

	//basic language defines
	define("ANTHEM_FAIL_INSTANTIATE", "Could not instantiate class");

?>