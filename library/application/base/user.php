<?php
	defined("ANTHEM_EXEC") or die;
	
	class User extends Generic {
		private $_name;
		private $_avatar;
		private $_password;
		private $_signature;
		private $_posts = 0;
		private $_join_date;
		private $_warning_level = 0;
	}

?>