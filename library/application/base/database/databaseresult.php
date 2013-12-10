<?php
	defined("ANTHEM_EXEC") or die;

	final class DatabaseResult extends Database {
		public function getQuery(){
			return $this->query_string;
		}

		public function getNumResults(){
			return $this->num_results;
		}

		//stub for future functionality
		public function getErrors(){

		}
	}

?>