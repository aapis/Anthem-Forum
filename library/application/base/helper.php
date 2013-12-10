<?php
	defined("ANTHEM_EXEC") or die;
	
	class Helper extends Generic {
		public function __construct($name){
			$this->helper_name_raw = $name;
			$this->helper_name = sprintf("%sHelper", ucwords($this->helper_name_raw));

			return $this;
		}

		//helpers are abstract classes, don't require instantiation and don't
		//need/support references
		public function load(){
			$helper_path = sprintf(BASE ."/app/helpers/%s.php", $this->helper_name_raw);
			
			if(require($helper_path)){ //may be unnecessary, testing required
				return class_exists($this->helper_name);
			}
			
			throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $this->helper_name));
		}
	}

?>