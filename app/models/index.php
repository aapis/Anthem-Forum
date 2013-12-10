<?php
	defined("ANTHEM_EXEC") or die;
	
	class IndexModel extends Model {
		public function getForums($results_only = true){
			//return $this->db->loadObjectList("SELECT * FROM #__test", $results_only);

			return $this->db->loadObjectList("SELECT id, forum_name as name, forum_description as description FROM #__forums ORDER BY id, forum_status");
		}
	}

?>