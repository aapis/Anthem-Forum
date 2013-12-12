<?php
	defined("ANTHEM_EXEC") or die;

	class View extends Generic implements AI_LoaderType {
		private $_view;
		private $_load;
		
		public $theme;

		public function __construct($name = null){
			if(false === is_null($name)){
				$this->_view = $name;
			}

			$this->_load = new Loader();

			$application = Application::getInstance();

			$this->set("theme", $application->getTheme());
			$this->set("html", $this->_load->library("library.libraries.html"));
		}

		/**
		 * Transforms regular strings into URL friendly strings
		 * @param  [type] $key [description]
		 * @return [type]      [description]
		 */
		public function slugify($key){
			$output = str_replace(" ", "-", strtolower($key)); //add regex for this shit later

			return $output;
		}

		public function load($file, $vars = array()){
			//expose user-defined data to the class and view
			$this->set("data", $vars);

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

				return null;
			}catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return true;
		}
	}

?>