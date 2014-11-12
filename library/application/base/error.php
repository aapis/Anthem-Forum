<?php
	defined("ANTHEM_EXEC") or die;
	
	/**
	 * Generic exception handling
	 */
	class Error extends Exception {
		public function __construct($value){
			if(is_numeric($value)){
				return $this->raise($value);
			}

			return $this->raise(404, $value);
		}

		public function raise($code = 404, $message = null){
			try {
				$name = sprintf("error-%s", $code);
				//$view = new View($name, array("isError", true));
				$view_path = sprintf(APP_PATH ."/views/errors/%s.php", $name);
				
				if(is_readable($view_path)){
					//$view->load($view_path, $message);
					return $this->_redirect($code);
					
					die();
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $view_path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}
		}

		private function _redirect($code){
			$app = Application::getInstance();
			
			return $app->redirect("/error", $code);
		}
	}

	//TODO: move to own class
	class InvalidFileException extends Error {

	}
?>