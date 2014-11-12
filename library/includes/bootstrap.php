<?php
	/**
	 * Include all core files, instantiate classes that require it and perform
	 * startup tasks
	 */

	defined("ANTHEM_EXEC") or die;

	//load up any interfaces
	include LIB_PATH . "application/base/interfaces/application.php";
	include LIB_PATH . "application/base/interfaces/loadertype.php";

	include LIB_PATH . 'application/base/generic.php';
	include LIB_PATH . 'application/base/genericlist.php';
	include LIB_PATH . 'application/base/genericiterator.php';
	include LIB_PATH . 'application/base/filepathresolver.php';
	//include LIB_PATH . 'application/base/user.php';
	include LIB_PATH . 'application/base/library.php';
	include LIB_PATH . 'application/base/view.php';
	include LIB_PATH . 'application/base/controller/controller.php';
	include LIB_PATH . 'application/base/controller/error.php';
	include LIB_PATH . 'application/base/model.php';
	include LIB_PATH . 'application/base/helper.php';
	include LIB_PATH . "application/base/database/database.php";
	include LIB_PATH . "application/base/database/databaseresult.php";
	include LIB_PATH . 'application/base/requesthandler.php';
	include LIB_PATH . 'application/base/router.php';
	include LIB_PATH . 'application/base/loader.php';
	include LIB_PATH . 'application/base/registry.php';
	include LIB_PATH . 'application/base/error.php';
	include LIB_PATH . 'application/base/application.php';

	include LIB_PATH . "application/environment/site.php";
	include LIB_PATH . "application/environment/cli.php";

	//startup app, set error reporting, etc
	if(ANTHEM_DEV){
		error_reporting(-1);
	}

?>