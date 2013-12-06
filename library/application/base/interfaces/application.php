<?php
	defined("ANTHEM_EXEC") or die;
	
	interface AI_Application {
		public static function getInstance();
		public function go();

	}

?>