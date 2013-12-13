<?php
	defined("ANTHEM_EXEC") or die;
	
	class CLIApplication implements AI_Application {
		private static $_instance;
		private $version = "0.0.1a";

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

			echo "Welcome to your Anthem Forum";
			
			return Router::route(new Request);
		}
	}

?>