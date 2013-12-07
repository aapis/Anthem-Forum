<?php
	/**
	 * License information
	 */
	
	define("ANTHEM_EXEC", true);
	define("BASE", realpath(dirname(__FILE__)));

	//load the defined constants
	include "library/defines.php";

	//load the configuration class
	include "configuration.php";

	//load the bootstrapper
	include "library/includes/bootstrap.php";

	$application = new Application();
	$application->initialize();
?>