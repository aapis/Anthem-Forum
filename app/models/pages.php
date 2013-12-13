<?php
	defined("ANTHEM_EXEC") or die;
	
	class PagesModel extends Model {
		public function __construct($request_args){
			$this->_request = $request_args;

			return parent::__construct();
		}

		public function getPages($results_only = true){
			$page = Request::get("args");
			$action = Request::get("action");
			$query = sprintf("SELECT id, forum_name as name, forum_description as description FROM #__forums ORDER BY id, forum_status");

			if($page !== $action){
				$query = sprintf("SELECT id, forum_name as name, forum_description as description FROM #__forums WHERE forum_slug LIKE \"%s\" ORDER BY id, forum_status", $page);
			}

			return $this->db->loadObjectList($query);
		}
	}

?>