<?php
	defined("ANTHEM_EXEC") or die;

	class Helper extends Generic implements AI_LoaderType {
		public function __construct(Generic $properties){
			$this->setProperties($properties);

			return $this;
		}

		public function load(){
			//$model_path = sprintf(BASE ."/app/models/%s.php", $this->path);
			
			if(require($this->path)){ //may be unnecessary, testing required
				$class = $this->class . ucwords($this->toString());

				if(class_exists($class)){
					return true;
				}

				throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $class));
			}

			return false;
		}
	}

?>