<?php
	/*
	 * Requires PHP::PDO to be enabled
	 */

	class Database {
		
		// Class variables
		public $query_string;
		
		private static $_instance;
		
		protected $factory;
		protected $handler;
		protected $tbl_prefix;
		protected $num_results = 0;
		
		/**
		 * Initialize the connection if required, return the instance if not
		 * TODO: refactor
		 * 		 Refactor query methods to allow for chaining
		 * 		 Should return a DatabaseResult object, not Generic
		 */
		private function __construct($args = array()){
			if(false === isset(self::$_instance)){
				$sConnection = sprintf("%s:host=%s;dbname=%s;", $args["driver"], $args["host"], $args["database"]);
				$this->tbl_prefix = "ant_";

				if(strlen($args["prefix"]) > 0){
					$this->tbl_prefix = $args["prefix"];
				}
				
				try {
					$this->factory = new PDO($sConnection, $args["user"], $args["password"]);
				}catch(PDOException $e){
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
		private function _as_object($type = "item", $results_only = true){
			$this->handler->setFetchMode(PDO::FETCH_OBJ);
			$this->handler->execute();
			
			$return = new DatabaseResult($this->tbl_prefix, $this->query_string);

			if($type == "item"){
				$_handler = $this->handler->fetch();

				$return->set($_handler->Database, $_handler);
			}
			
			if($type == "list"){
				$i = 0;
				$return->set("results", array());

				while($row = $this->handler->fetch()){
					$return->results[$i] = $row;
					$i++;
				}

				$this->num_results = $i;//sizeof($return); //$i;
			}

			if($results_only){
				return $return->results;
			}
				
			return $return;
		}

		/**
		 * [Return an array of arrays]
		 * @param  [string] $query_string [The query string you want to run]
		 * @return [array]
		 */
		public function loadArrayList($query_string = null, $results_only = true){
			$this->query_string = $this->_parseQueryString($query_string);
			$this->_query();
			
			return $this->_as_array("list", $results_only);
		}

		//stub for future functionality
		public function loadResult($query_string = null, $results_only = true){
			//load one item in array form
		}

		/**
		 * [Return a list of objects]
		 * @param  [string] $query_string [The query string you want to run]
		 * @return [array]
		 */
		public function loadObjectList($query_string = null, $results_only = true){
			$this->query_string = $this->_parseQueryString($query_string);
			$this->_query();
			
			return $this->_as_object("list", $results_only);
		}

		/**
		 * [Returns a single object]
		 * @param  [type] $query_string [description]
		 * @return [type]               [description]
		 */
		public function loadObject($query_string = null, $results_only = true){
			$this->query_string = $this->_parseQueryString($query_string);
			$this->_query();
			
			return $this->_as_object("item", $results_only);
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
			$this->query_string = $this->_parseQueryString($query_string);

			$result = $this->factory->exec($query_string);

			if($result === 0){
				throw new Error("Query failed to run, 0 results");
			}

			return !!$result;
		}

		private function _parseQueryString($string){
			return str_replace("#__", $this->tbl_prefix, $string);
		}
	}
?>