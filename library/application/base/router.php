<?php
	defined("ANTHEM_EXEC") or die;

	class Router {
		
		public static function route(Request $request){
			
			$controllerFileName = $request->getController();
			$method = $request->getMethod();
			$args = $request->getArgs();

			$controllerFile = APP_PATH. '/controllers/'. $controllerFileName .'.php';

			if(is_readable($controllerFile)){
				require_once $controllerFile;
				
				$class = $controllerFileName."Controller";

				$controller = new $class;
				$method = (is_callable(array($controller,$method))) ? $method : 'display';
				
				if(!empty($args)){
					call_user_func_array(array($controller,$method),$args);
				}else{	
					call_user_func(array($controller,$method));
				}

				return true;
			}

			throw new Exception('404 - '.$request->getController().' not found');
		}
	}
