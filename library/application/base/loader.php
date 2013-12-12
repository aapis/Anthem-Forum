<?php
	defined("ANTHEM_EXEC") or die;

	class Loader extends Generic {
		//problem is here
		public function view($name, $vars = array()){
			try {
				$view = new View($name);
				$view_path = sprintf(APP_PATH ."views/%s.php", $name);

				if(is_readable($view_path)){
					return $view->load($view_path, $vars);
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $view_path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}
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

		public function helper($name = null, $environment = "app"){
			try {
				$helper = new Helper($name);
				$file = FilePathAbsolver::getInstance()->process($name);

				if($file->exists){
					return $helper->load($file->path);
				}
				
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $file->path));
			} catch(InvalidFileException $e){
				echo $e->getMessage();
			}

			return false;
		}

		public function library($name = null){

		}
	}
