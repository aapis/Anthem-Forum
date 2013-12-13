<?php
	defined("ANTHEM_EXEC") or die;
	
	class ForumController extends Controller {
		
		public function __construct($args = array()){
			$this->request = $args;

			parent::__construct();
		}

		public function display(){
			//$model = $this->load->model(), gets name of class dynamically
			$forums = $this->model->get("forum");

			$this->load->view("forum", $forums);
		}
	}
?>
