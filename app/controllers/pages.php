<?php
	defined("ANTHEM_EXEC") or die;

	class PagesController extends Controller {
		public function __construct(){
			return parent::__construct();
		}

		public function display(){
			$pages = $this->model->get("pages");
			
			return $this->load->view("pages", $pages);
		}
	}

?>