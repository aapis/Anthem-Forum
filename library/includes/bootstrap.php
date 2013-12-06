<?php
	/**
	 * Include all core files, instantiate classes that require it and perform
	 * startup tasks
	 */

	defined("ANTHEM_EXEC") or die;

	//load up any interfaces
	include SITE_PATH . "application/base/interfaces/application.php";

	include SITE_PATH . "application/base/database.php";
	include SITE_PATH . 'application/base/object.php';
	include SITE_PATH . 'application/base/request.php';
	include SITE_PATH . 'application/base/router.php';
	include SITE_PATH . 'application/base/controller.php';
	include SITE_PATH . 'application/base/model.php';
	include SITE_PATH . 'application/base/loader.php';
	include SITE_PATH . 'application/base/registry.php';
	include SITE_PATH . 'application/base/error.php';
	include SITE_PATH . 'application/base/application.php';

	include SITE_PATH . "application/environment/site.php";
	include SITE_PATH . "application/environment/cli.php";

?>