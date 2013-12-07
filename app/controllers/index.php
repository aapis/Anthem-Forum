<?php
	defined("ANTHEM_EXEC") or die;

	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			//$this->load->model('posts');
			
			//$vars['title'] = 'Dynamic title';
			//$vars['posts'] = $this->posts->getEntries();
			$vars = array();
			$vars["pageTitle"] = "Test page";
			$vars["test"] = "foop";
			$test = new Generic();
			$test->set("test", "value");
			
			$this->load->view('index', $test);
		}

	}
