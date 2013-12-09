<?php

	defined("ANTHEM_EXEC") or die;

	error_reporting(0);
	
	define("SITE_PATH", realpath(dirname(__FILE__)).'/');
	define("APP_PATH", BASE . "/app");
	define("ANTHEM_DEV", true);

	//basic language defines
	define("ANTHEM_FAIL_INSTANTIATE", "Could not instantiate class");

	if(ANTHEM_DEV){
		error_reporting(-1);
	}

?>