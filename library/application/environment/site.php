<?php
	defined("ANTHEM_EXEC") or die;
	
	class SiteApplication implements AI_Application {
		private static $_instance;

		private function __construct(){

		}

		public static function getInstance(){
			if(!self::$_instance instanceof self){
				self::$_instance = new SiteApplication();
			}
			return self::$_instance;
		}

		public function go(){
			return Router::route(new Request);
		}
	}

?>