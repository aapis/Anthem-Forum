<?php
	defined("ANTHEM_EXEC") or die;

	class Controller extends Generic implements AI_LoaderType {
		
		protected $_registry;
		protected $load;
		protected $model;

		public function __construct(){
			$this->_registry = Registry::getInstance();
			$this->load = new Loader();
			$this->model = $this->load->model($this->getSlug());

			//helpers are abstract, just include them
			$this->load->helper("library.helpers.request");

			//libraries are instantiated, create a reference to the object
			$this->set("logger", $this->load->library("library.libraries.logger"));
			
		}

		public function error(){
			echo "test";
		}

		protected function getSlug(){
			if(strpos($this->toString(), "Controller") > 0){
				return strtolower(str_replace("Controller", "", $this->toString()));
			}

			return null;
		}

		public function load(){
			return;
		}

		final public function __get($key){
			if($return = $this->_registry->$key){
				return $return;
			}
			
			return false;
		}	
	}
?>
