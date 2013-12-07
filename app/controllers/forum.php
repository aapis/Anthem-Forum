<?php

class ForumController extends Controller {
	
	public function display(){
		echo '<pre>'.print_r(__METHOD__,1).'</pre>';	
		
	}


	public function peas(){
		echo '<pre>'.print_r(__METHOD__,1).'</pre>';	
		echo '<pre>'.print_r(func_get_args(),1).'</pre>';	
		
	}
}
