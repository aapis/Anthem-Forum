<?php
	defined("ANTHEM_EXEC") or die;

	class FilePathAbsolver extends Generic {
		private static $_instance;

		public function process($argument){
			$parts = explode(".", $argument);
			$size = sizeof($parts);
			$ret = null;

			if($size > 0){
				$ret = new Generic();

				if($size > 1){ //there is a folder
					$ret->set("folders", array_slice($parts, 0, -1));
				}else {
					$ret->set("folders", array("app", "helpers"));
				}

				$ret->set("file", $parts[$size-1]);

				$file = $this->_getFile($ret);

				if(false === $file->exists){
					$this->setError(sprintf("File not found: <strong>%s</strong>", $file->path));
				}

				$ret = $file;
			}else {
				$this->setError("Not enough elements in $size");
			}



			return $ret;
		}

		private function _getFile(Generic $parts){
			$ret = new Generic();
			$ret->exists = false;
			$ret->path = BASE;

			foreach($parts->folders as $folder){
				$ret->path .= "/". $folder;
			}

			$ret->path .=  "/". $parts->file .".php";

			if(file_exists($ret->path)){
				$ret->exists = true;
			}

			return $ret;
		}

		public static function getInstance(){
			if(false === self::$_instance instanceof self){
				$class = __CLASS__;
				
				self::$_instance = new $class;
			}
			
			return self::$_instance;
		}
	}

?>