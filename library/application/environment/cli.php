<?php
	defined("ANTHEM_EXEC") or die;
	
	class CLIApplication implements AI_Application {
		private static $_instance;

		private function __construct(){

		}

		public static function getInstance(){
			if(!self::$_instance instanceof self){
				self::$_instance = new CLIApplication();
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