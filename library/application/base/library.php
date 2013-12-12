<?php
	defined("ANTHEM_EXEC") or die;
	
	class Library extends Generic implements AI_LoaderType {
		public function __construct($properties = null){
			$this->setProperties($properties);
			$application = Application::getInstance();
			$this->db = $application->getDBO();

			return $this;
		}

		public function load(){
			if(require($this->path)){
				$class = $this->class . ucwords($this->toString());

				if(class_exists($class)){
					$_toLoad = new $class();

					return $_toLoad;
				}

				throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $class));
			}

			return false;
		}
	}

?>