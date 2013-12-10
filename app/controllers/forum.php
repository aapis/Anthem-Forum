<?php
	defined("ANTHEM_EXEC") or die;
	
	class ForumController extends Controller {
		
		public function __construct($args = array()){
			$this->request = $args;

			parent::__construct();
		}

		public function display(){
			//$model = $this->load->model(), gets name of class dynamically
			$model = $this->load->model("forum", $this->request);
			$forums = $model->get("forum");
			
			//$this->load->helper("demo");

			$this->load->view("forum", $forums);
		}
	}
?>
