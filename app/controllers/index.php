<?php
	class indexController extends Controller {
		
		public function __construct(){
			parent::__construct();
		}

		public function display(){
			//$this->load->model('posts');
			
			//$vars['title'] = 'Dynamic title';
			//$vars['posts'] = $this->posts->getEntries();
			$vars = array();

			$this->load->view('index',$vars);
		}

	}
