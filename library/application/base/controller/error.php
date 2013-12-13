<?php

	class ErrorController extends Generic implements AI_LoaderType {
		public function __construct(){
			//$this->_registry = Registry::getInstance();
			$this->load = new Loader();

			//helpers are abstract, just include them
			$this->load->helper("library.helpers.request");

			//libraries are instantiated, create a reference to the object
			$this->set("logger", $this->load->library("library.libraries.logger"));
		}

		public function display($code = 404, $errors = array()){
			return $this->load->view(sprintf("app.views.errors.error-%s", $code), $errors);
		}
	}

?>