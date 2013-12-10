<?php
	defined("ANTHEM_EXEC") or die;
	
	class IndexModel extends Model {
		public function __construct($request_args){
			$this->_request = $request_args;

			return parent::__construct();
		}

		public function getForums($results_only = true){
			//return $this->db->loadObjectList("SELECT * FROM #__test", $results_only);

			return $this->db->loadObjectList("SELECT id, forum_name as name, forum_description as description FROM #__forums ORDER BY id, forum_status");
		}
	}

?>