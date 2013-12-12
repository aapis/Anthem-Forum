<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * System Library: HTML
	 *
	 * Generates HTML elements
	 */
	class Html extends Library {
		private static $_instance;

		public function a($link = null, $name = null, $external = false){
			try {
				if($external){
					$output = sprintf("<a href=\"%s\" target=\"_blank\">%s</a>", $link, $name);
				}else {
					$output = sprintf("<a href=\"%s\">%s</a>", $link, $name);
				}
				
				return $output;
			}catch(Exception $e){ //use better exception type
				echo $e->getMessage();
			}
		}

		public static function getInstance(){
			if(false === self::$_instance instanceof self){
				$class = __CLASS__;
				
				self::$_instance = new $class();
			}
			
			return self::$_instance;
		}

	}

?>