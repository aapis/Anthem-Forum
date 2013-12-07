<?php
	defined("ANTHEM_EXEC") or die;

	class Model extends Generic {
		private $model_name;
		private $model_name_raw;

		public function __construct($name){
			$this->model_name_raw = $name;
			$this->model_name = sprintf("%sModel", ucwords($name));

			return $this;
		}

		public function load(){
			$model_path = sprintf(BASE ."/app/models/%s.php", $this->model_name_raw);
			
			if(require($model_path)){ //may be unnecessary, testing required
				if(class_exists($this->model_name)){
					$model = new $this->model_name;

					return $model;
				}

				throw new InvalidFileException(sprintf("Class not found: <strong>%s</strong>", $this->model_name));
			}
		}

		public function get($key){
			$method = sprintf("get%s", ucwords($key));

			if(method_exists($this, $method)){
				return $this->$method();
			}

			return false;
		}
	}
?>
