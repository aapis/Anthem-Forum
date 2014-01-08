<?php
	defined("ANTHEM_EXEC") or die;

	class View extends Generic implements AI_LoaderType {
		private $_view;
		private $_load;
		
		public $theme;

		public function __construct($properties = null, $vars = array()){
			$this->setProperties($properties);

			$this->_load = new Loader();

			$application = Application::getInstance();
			
			$this->set("theme", $application->getTheme());
			$this->set("html", $this->_load->library("library.libraries.html"));
			$this->set("data", $vars);
			$this->set("pageTitle", $this->get("class"));

			return $this;
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

		public function load(){
			//include the theme's header/footer files if they exist
			$path = array();
			$path["header"] = sprintf(APP_PATH ."themes/%s/header.php", $this->theme);
			$path["footer"] = sprintf(APP_PATH ."themes/%s/footer.php", $this->theme);

			try {
				if(isset($this->path)){
					if(file_exists($path["header"])){
						require($path["header"]);
					}else {
						throw new InvalidFileException(sprintf("File not found: %s", $path["header"]));
					}

					if(file_exists($this->path)){
						require($this->path);
					}else {
						throw new InvalidFileException(sprintf("File not found: %s", $this->path));
					}

					if(file_exists($path["footer"])){
						require($path["footer"]);
					}else {
						throw new InvalidFileException(sprintf("File not found: %s", $path["footer"]));
					}
				}else {
					//this doesn't really work at all
					$error = new Error();
					$error->raise(404, "test");
				}

				return null;
			}catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return true;
		}
	}

?>