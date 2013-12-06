<?php
	defined("ANTHEM_EXEC") or die;

	class Loader {
		//problem is here
		public function view($name,array $vars = null){
			$file = APP_PATH .'/views/'.$name.'.php';

			if(is_readable($file)){
				if(isset($vars)){
					extract($vars);
				}
				
				require($file);
				return true;
			}
			throw new Exception('View issues');
		}

		public function model($name){
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
	}
