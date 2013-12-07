<?php
	defined("ANTHEM_EXEC") or die;

	class Loader {
		//problem is here
		public function view($name, $vars = array()){
			$file = APP_PATH .'/views/'.$name.'.php';

			//initialize the view class here to do a bunch of stuff, including
			//loading the header and footer files from the current theme directory
			$view = new View($name);

			//wrap in try/catch for new exception type InvalidView
			//try {
			if(is_readable($file)){
				$view->load($file, $vars);
			}else {
				throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $file));
			}
			//} catch(InvalidFileException $e){
			//	echo $e->getMessage();
			//}
		}

		public function modelOLD($name){
			$model = $name.'Model';
			$modelPath = APP_PATH .'/models/'.$model.'.php';

			if(is_readable($modelPath)){
				require_once($modelPath);

				if(class_exists($model)){
					$registry = Registry::getInstance();
					$registry->$name = new $model;
					return true;
				}
			}
			throw new Exception('Model issues.');
		}

		public function model($name = null){
			if(false === is_null($name)){
				$model = new Model($name);
				$model_path = sprintf(BASE ."/app/models/%s.php", $name);
				
				if(is_readable($model_path)){
					return $model->load();
				}else {
					throw new InvalidFileException(sprintf("Could not read file <strong>%s</strong>", $model_path));
				}
			}
		}
	}
