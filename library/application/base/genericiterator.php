<?php

	//namespace Library\Application\Base\GenericIterator;
	
	class GenericIterator extends GenericList {
		/**
		 * Short hand for method to loop through GenericList items
		 * TODO: implement a counter to pass to callback
		 * @param  function $callback      A function to call which handles data within the loop
		 * @param  array   $out_of_scopes  A list of objects which should be added to the local scope
		 * @return mixed
		 */
		public function each($callback, $out_of_scopes = array()){
			try {
				if(is_callable($callback)){
					$oos = new GenericList($out_of_scopes);
					$counter = 1;

					switch($this->_type){
						case "numeric":
							for($i = 0; $i < sizeof($this->_bucket); $i++){
								$oos->push($counter++);
								$callback($i, $this->_bucket[$i], $oos);
							}
						break;

						case "associative":
							foreach($this->_bucket as $item){
								$oos->push($counter++);
								$callback($item, $oos);
							}
						break;

						default:
							throw new Exception("GenericList::loop - invalid array type");
					}

					return $this;
				}else {
					throw new Exception("GenericList::loop requires a function for the callback argument.");
				}
			}catch(Exception $e){
				echo $e->getMessage();
			}

			return false;
		}

		public function current(){

		}

		public function next(){

		}

		public function previous(){
			
		}
	}

?>