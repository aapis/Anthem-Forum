<?php
	defined("ANTHEM_EXEC") or die;

	class Helper extends Generic implements AI_LoaderType {
		public function __construct(Generic $properties){
			$this->setProperties($properties);

			return $this;
		}

		public function load(){
			if(require($this->path)){
				if(class_exists($this->class)){
					return true;
				}

				throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $this->class));
			}

			return false;
		}
	}

?>