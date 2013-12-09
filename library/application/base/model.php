<?php
	defined("ANTHEM_EXEC") or die;

	//extends Generic - removed for strict standards compliance, should modify 
	//Generic/this maybe?
	class Model {
		private $model_name;
		private $model_name_raw;

		protected $db;

		public function __construct($name = null){
			$this->model_name_raw = $name;
			$this->model_name = sprintf("%sModel", ucwords($this->model_name_raw));
			$application = Application::getInstance();
			$this->db = $application->getDBO();

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

		/**
		 * Get a function from the associated model
		 * @param  [type]  $key          Function name to get data from 
		 *                               (excluding the "get") - i.e.
		 *                               Model::getForum, $model->get("forum")
		 * @param  boolean $results_only Show only the results of the query, 
		 *                                default is true.  False returns the 
		 *                                whole DatabaseResult object
		 * @return boolean               
		 */
		public function get($key, $results_only = true){
			$method = sprintf("get%s", ucwords($key));

			if(method_exists($this, $method)){
				return $this->$method($results_only);
			}

			return false;
		}
	}
?>
