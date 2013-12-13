<?php
	defined("ANTHEM_EXEC") or die;

	class Router {
		
		public static function route(RequestHandler $request){
			
			$controllerFileName = $request->getController();
			$method = $request->getMethod();
			$args = $request->getArgs();
			
			//search the APP_PATH for a valid controller
			$controllerFile = sprintf("%s/controllers/%s.php", APP_PATH, $controllerFileName);

			//search the LIB_PATH for a valid controller if one isn't found in
			//APP_PATH
			if(false === is_readable($controllerFile)){
				$controllerFile = sprintf("%sapplication/base/controller/%s.php", LIB_PATH, $controllerFileName);
			}

			if(is_readable($controllerFile)){
				require_once $controllerFile;
				
				$controllerFileName = ucwords($controllerFileName);

				$class = $controllerFileName."Controller";

				$controller = new $class($args);
				$method = (is_callable(array($controller,$method))) ? $method : 'display';

				if(!empty($args)){
					call_user_func_array(array($controller,$method),$args);
				}else{	
					call_user_func(array($controller,$method));
				}

				return true;
			}

			throw new Exception('404 - '. $controllerFileName .' not found');
		}
	}
