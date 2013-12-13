<?php
	defined("ANTHEM_EXEC") or die;

	class Loader extends Generic {
		private $_resolver;

		public function __construct(){
			$this->_resolver = FilePathResolver::getInstance();
		}

		/**
		 * Creates a new view with all the required properties
		 * @param  [type] $name [description]
		 * @param  array  $vars [description]
		 * @return [type]       [description]
		 */
		public function view($name = null, $vars = array()){
			try {
				$file = $this->_resolver->process($name, "views");
				$view = new View($file, $vars);

				if($file->exists){
					return $view->load();
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $file->path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return false;
		}

		public function model($name = null, $request_args = array()){
			try {
				$model = new Model($name);
				$model_path = sprintf(APP_PATH ."models/%s.php", $name);
				
				if(is_readable($model_path)){
					return $model->load($request_args);
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $model_path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return false;
		}

		public function helper($name = null){
			try {
				$file = $this->_resolver->process($name, "helpers");
				$helper = new Helper($file);

				if($file->exists){
					return $helper->load();
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $file->path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return false;
		}

		public function library($name = null){
			try {
				$file = $this->_resolver->process($name, "libraries");
				$library = new Library($file);

				if($file->exists){
					return $library->load();
				}

				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $file->path));
			}catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return false;
		}
	}
