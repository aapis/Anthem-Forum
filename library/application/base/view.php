<?php
	defined("ANTHEM_EXEC") or die;

	class View extends Generic {
		private $_view;
		
		public $theme;

		public function __construct($name = null){
			if(false === is_null($name)){
				$this->_view = $name;
			}

			$application = Application::getInstance();

			$this->set("theme", $application->getTheme());
		}

		public function load($file, $vars = array()){
			//expose user-defined variables to the class and view
			$this->setProperties($vars);

			//include the theme's header/footer files if they exist
			$path = array();
			$path["header"] = sprintf(BASE ."/app/themes/%s/header.php", $this->theme);
			$path["footer"] = sprintf(BASE ."/app/themes/%s/footer.php", $this->theme);

			try {
				if(file_exists($path["header"])){
					require($path["header"]);
				}else {
					throw new InvalidFileException(sprintf("File not found: %s", $path["header"]));
				}

				if(file_exists($file)){
					require($file);
				}else {
					throw new InvalidFileException(sprintf("File not found: %s", $file));
				}

				if(file_exists($path["footer"])){
					require($path["footer"]);
				}else {
					throw new InvalidFileException(sprintf("File not found: %s", $path["footer"]));
				}
			}catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return true;
		}
	}

?>