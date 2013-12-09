<?php
	defined("ANTHEM_EXEC") or die;
	
	final class DatabaseResult extends Generic {

		public function __construct($prefix, $query){
			$this->set("prefix", $prefix);
			$this->set("query", $query);
		}

		public function getQuery(){
			return $this->_parseQueryString($this->query);
		}

		private function _parseQueryString($string){
			return str_replace("#__", $this->prefix, $string);
		}
	}

?>