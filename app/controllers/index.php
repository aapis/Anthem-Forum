<?php
	defined("ANTHEM_EXEC") or die;

	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			$vars = array();
			$vars["pageTitle"] = "Test page";
			$vars["test"] = "foop";
			$test = new Generic();
			$test->set("test", "value");

			$model = $this->load->model("index");
			$forums = $model->get("forums");
			var_dump($forums);

			$this->load->view('index', $test);
		}

	}
