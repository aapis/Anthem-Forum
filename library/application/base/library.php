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
				if(class_exists($this->class)){
					$_toLoad = new $this->class();

					return $_toLoad;
				}

				throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $this->class));
			}

			return false;
		}

		public function test(){
			return $this->toString();
		}
	}

?>