<?php
	/**
	 * Include all core files, instantiate classes that require it and perform
	 * startup tasks
	 */

	defined("ANTHEM_EXEC") or die;

	//load up any interfaces
	include SITE_PATH . "application/base/interfaces/application.php";
	include SITE_PATH . "application/base/interfaces/loadertype.php";

	include SITE_PATH . 'application/base/generic.php';
	include SITE_PATH . 'application/base/filepathresolver.php';
	//include SITE_PATH . 'application/base/user.php';
	include SITE_PATH . 'application/base/library.php';
	include SITE_PATH . 'application/base/view.php';
	include SITE_PATH . 'application/base/controller.php';
	include SITE_PATH . 'application/base/model.php';
	include SITE_PATH . 'application/base/helper.php';
	include SITE_PATH . "application/base/database/database.php";
	include SITE_PATH . "application/base/database/databaseresult.php";
	include SITE_PATH . 'application/base/requesthandler.php';
	include SITE_PATH . 'application/base/router.php';
	include SITE_PATH . 'application/base/loader.php';
	include SITE_PATH . 'application/base/registry.php';
	include SITE_PATH . 'application/base/error.php';
	include SITE_PATH . 'application/base/application.php';

	include SITE_PATH . "application/environment/site.php";
	include SITE_PATH . "application/environment/cli.php";

	//startup app, set error reporting, etc
	if(ANTHEM_DEV){
		error_reporting(-1);
	}

?>