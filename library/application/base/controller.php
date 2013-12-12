<?php
	defined("ANTHEM_EXEC") or die;

	class Controller extends Generic {
		
		protected $_registry;
		protected $load;

		public function __construct(){
			$this->_registry = Registry::getInstance();
			$this->load = new Loader();

			//load default classes
			$this->load->helper("library.helpers.request");
			$this->load->helper("demo");
			
			//$this->load->library("logger");
		}

		final public function __get($key){
			if($return = $this->_registry->$key){
				return $return;
			}
			
			return false;
		}	
	}
?>
