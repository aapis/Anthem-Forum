<?php
	defined("ANTHEM_EXEC") or die;

	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			$model = $this->load->model("index");
			$forums = $model->get("forums");
			
			//$this->load->helper("demo");

			$this->load->view("index", $forums);
		}

	}
