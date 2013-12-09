<?php
	defined("ANTHEM_EXEC") or die;
	
	class IndexModel extends Model {
		public function getForums(){
			return $this->db->loadObject("SHOW DATABASES;");
		}
	}

?>