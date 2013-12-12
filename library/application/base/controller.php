<?php
	defined("ANTHEM_EXEC") or die;

	class Controller extends Generic implements AI_LoaderType {
		
		protected $_registry;
		protected $load;

		public function __construct(){
			$this->_registry = Registry::getInstance();
			$this->load = new Loader();

			//helpers are abstract, just include them
			$this->load->helper("library.helpers.request");

			//libraries are instantiated, create a reference to the object
			$this->set("logger", $this->load->library("library.libraries.logger"));
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
