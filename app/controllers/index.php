<?php
	defined("ANTHEM_EXEC") or die;

	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			$vars = array();
			$vars["pageTitle"] = "Test page";

			$model = $this->load->model("index");
			$forums = $model->get("forums");
			
			$this->load->helper("demo");

			$this->load->view('index');
		}

	}
