<?php
	defined("ANTHEM_EXEC") or die;
	
	class SiteApplication implements AI_Application {
		private static $_instance;
		private $version = "0.0.1a";

		public function getApplication(){
			return parent::getInstance();
		}

		public static function getInstance(){
			if(!self::$_instance instanceof self){
				$class = __CLASS__;

				self::$_instance = new $class();
			}
			return self::$_instance;
		}

		public function go(){
			if(false === file_exists(BASE ."/configuration.php")){
				throw new Error("Missing config file.");
			}
			
			if(false === defined('PDO::ATTR_DRIVER_NAME')){
				throw new Error("Missing PDO driver, please install php_pdo.so/dll");
			}

			return Router::route(new RequestHandler);
		}
	}

?>