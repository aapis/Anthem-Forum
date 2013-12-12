<?php
	defined("ANTHEM_EXEC") or die;

	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			$forums = $this->model->get("forums");

			return $this->load->view("index", $forums);
		}

	}
