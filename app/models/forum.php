<?php
	defined("ANTHEM_EXEC") or die;
	
	class ForumModel extends Model {
		private $_request = array();

		public function __construct($request_args){
			$this->_request = $request_args;

			return parent::__construct();
		}

		public function getForum($results_only = true){
			//return $this->db->loadObjectList("SELECT * FROM #__test", $results_only);

			return $this->db->loadObject(sprintf("SELECT id, forum_name as name, forum_description as description FROM #__forums WHERE forum_slug = '%s' ORDER BY id, forum_status", $this->db->escape($this->_request[0])));
		}
	}

?>