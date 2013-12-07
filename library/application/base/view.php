<?php
	defined("ANTHEM_EXEC") or die;

	class View extends Generic {
		private $load;

		private $_view;
		
		public $theme;

		public function __construct($name = null){
			if(false === is_null($name)){
				$this->_view = $name;
			}

			$application = Application::getInstance();

			$this->theme = $application->getTheme();
		}

		/*public function display(){
			$this->load->header; //or something
			$this->load->thethingIwant; //or something
			$this->load->footer; //or something
		}*/

		public function load($file, $vars = array()){
			//expose user-defined variables to the class and view
			$this->setProperties($vars);

			//include the theme's header/footer files if they exist
			$path = array();
			$path["header"] = sprintf(BASE ."/app/themes/%s/header.php", $this->theme);
			$path["footer"] = sprintf(BASE ."/app/themes/%s/footer.php", $this->theme);

			if(file_exists($path["header"])){
				require($path["header"]);
			}

			require($file);

			if(file_exists($path["footer"])){
				require($path["footer"]);
			}

			return true;
		}
	}

?>