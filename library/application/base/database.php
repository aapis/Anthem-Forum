<?php
	/*
	 * Requires PHP::PDO to be enabled
	 */

	class Database {
		
		// Class variables
		private $query_string = null;
		
		private static $_instance = null;
		
		protected $factory = null;
		protected $handler = null;
		protected $num_results = 0;
		
		/**
		 * Initialize the connection if required, return the instance if not
		 * TODO: refactor
		 * 		 Refactor query methods to allow for chaining
		 */
		private function __construct($args = array()){
			if(false === isset(self::$_instance)){
				$sConnection = sprintf("%s:host=%s;dbname=%s;", $args["driver"], $args["host"], $args["database"]);
				
				try {
					$this->factory = new PDO($sConnection, $args["user"], $args["password"]);
				}catch(PDOException $e){
					//MA_ErrorHandler::Message('error', $e->getMessage());
					throw new Error($e->getMessage()); //this may prove to be a bad idea
				}
				
			}else {
				return self::$_instance; 
			}
		}
		
		/**
		 * [Initialize the connection if required, return the instance if not]
		 * @return [object]
		 */
		public static function getInstance($args = array()){
			if(false === isset(self::$_instance)){
				$class = __CLASS__;

				if(false === empty($args)){
					self::$_instance = new $class($args);
				}else {
					//MA_ErrorHandler::Message('error', self::MA_COULD_NOT_INSTANTIATE);
					throw new Error(ANTHEM_FAIL_INSTANTIATE);
				}
			}
			
			return self::$_instance;
		}
		
		/**
		 * [Prepare the query, set $this->handler for use in other methods]
		 * @return [object] For chaining
		 */	
		private function _query(){
			$this->handler = $this->factory->prepare($this->query_string, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

			return $this->handler;
		}
		
		/**
		 * [Parse a query result into an array we can use]
		 * @return [array]
		 */
		private function _as_array(){
			$this->handler->setFetchMode(PDO::FETCH_ASSOC);
			$this->handler->execute();
			
			$return = array();
			$i = 0;
			
			while($row = $this->handler->fetch()){
				$return[$i] = $row;
				
				$i++;
			}

			$this->num_results = $i;

			return $return;
		}
		
		/**
		 * [Parse a query result into an object we can use]
		 * @return [object]
		 */
		private function _as_object($type = "item"){
			$this->handler->setFetchMode(PDO::FETCH_OBJ);
			$this->handler->execute();
			
			$return = new Generic(); //new stdClass();

			if($type == "item"){
				$_handler = $this->handler->fetch();

				$return->set($_handler->Database, $_handler);
			}
			
			if($type == "list"){
				$i = 0;

				while($row = $this->handler->fetch()){
					//$return->$i = $row;
					$return->set($row->Database, $row);
					//$return->set($i, $row);
					
					$i++;
				}
				//$return->setProperties($this->handler->fetch());

				$this->num_results = $i;//sizeof($return); //$i;
			}
				
			return $return;
		}

		/**
		 * [Return an array of arrays]
		 * @param  [string] $query_string [The query string you want to run]
		 * @return [array]
		 */
		public function loadArrayList($query_string = null){
			$this->query_string = $query_string;
			$this->_query();
			
			return $this->_as_array();
		}

		public function loadResult($query_string = null){
			//load one item in array form
		}

		/**
		 * [Return a list of objects]
		 * @param  [string] $query_string [The query string you want to run]
		 * @return [array]
		 */
		public function loadObjectList($query_string = null){
			$this->query_string = $query_string;
			$this->_query();
			
			return $this->_as_object("list");
		}

		/**
		 * [Returns a single object]
		 * @param  [type] $query_string [description]
		 * @return [type]               [description]
		 */
		public function loadObject($query_string = null){
			$this->query_string = $query_string;
			$this->_query();
			
			return $this->_as_object("item");
		}

		/**
		 * [Get the number of affected rows from the query]
		 * @return [int] [The number of affected rows]
		 */
		public function loadNumResults(){
			return $this->num_results;
		}
		
		/**
		 * [Run boolean queries (insert, delete, etc)]
		 * @return [bool]
		 */
		public function execute($query_string = null){
			$this->query_string = $query_string;

			$result = $this->factory->exec($query_string);

			if($result === 0){
				MA_ErrorHandler::Message('warning', 'Query failed to run, 0 results.', $query_string);
			}

			return !!$result;
		}
	} //end class

	/**
	 * Class: MA_ErrorHandler
	 * 
	 * Error handling for MA_Database
	 * DEPRECATED for global Error exception handling 
	 * TODO: remove me
	 */
	abstract class MA_ErrorHandler {
		/**
		 * [Message Display messages to the user]
		 * @return [string]
		 */
		public static function Message($type = 'error', $message = null, $query_string = null){
			switch($type){
				case 'error': 
					self::Error($message, $query_string);
				break;

				case 'warning':
					self::Warning($message, $query_string);
				break;
			}
		}

		/**
		 * [Error Display errors as obnoxiously as possible]
		 * @return [string]
		 */
		private function Error(){
			$errors = func_get_args();

			if(false === empty($errors)){
				echo '<div class="user-message error">';
					foreach($errors as $error){
						echo '<h3>'. $error .'</h3>';
					}
				echo '</div>';
			}

			die();
		}

		/**
		 * [Warning Display warnings to the user]
		 * @return [string]
		 */
		private function Warning(){
			$warnings = func_get_args();

			if(false === empty($warnings)){
				echo '<div class="user-message warning">';
					foreach($warnings as $warning){
						echo '<h3>'. $warning .'</h3>';
					}
				echo '</div>';
			}
		}
	} //end class
?>