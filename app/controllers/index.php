<?php
	class IndexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			//$this->load->model('posts');
			
			//$vars['title'] = 'Dynamic title';
			//$vars['posts'] = $this->posts->getEntries();
			$vars = array();
			$test = new Object();
			$test->set("test", "value");

			$this->load->view('index');
		}

	}
