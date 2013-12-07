<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * Generic object class
	 */
	class Generic {
		public function __construct($properties = array()){
			//if(sizeof($properties) > 0){
				//$this->setProperties($properties);
			//}

			return $this;
		}

		public function toString(){
			return get_class($this);
		}

		public function get($key, $default = null){
			$ret = $default;

			if(isset($this->key)){
				$ret = $this->$key;
			}

			return $ret;
		}

		public function set($key, $value){
			$ret = (isset($this->$key) ? $this->$key : null);
			
			$this->$key = $value;
			
			return $ret;
		}

		public function setProperties($properties = array()){
			if(sizeof($properties) > 0){
				foreach($properties as $key => $value){
					$this->$key = $value;
				}

				return true;
			}

			return false;
		}

		public function getProperties(){
			$ret = array();

			$properties = get_object_vars($this);

			foreach($properties as $key => $value){
				if(strpos($key, "_") === false){
					$ret[] = array($key => $value);
				}
			}

			return $ret;
		}
	}

?>