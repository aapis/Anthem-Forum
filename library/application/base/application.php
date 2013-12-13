<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * Factory object
	 */
	class Application {
		private $_config;
		private $_title;

		private static $_instance;

		public function __construct(){
			$this->_config = new Config();
		}

		//instantiate the config class and expose certain properties
		public function getConfig($key = null){
			$ret = $this->_config;

			if(false === is_null($key)){
				$ret = $this->_config->$key;
			}
			
			return $ret;
		}

		public function getUser(){

		}

		//log_path for custom logs
		public function getLogger($log_path = null){
			$logger = Logger::getInstance($log_path);

			return $logger;
		}

		public function getDBO(){
			$connection_opts = array(
				"password" => $this->_config->db_password,
				"user"     => $this->_config->db_user, 
				"host"     => $this->_config->db_host,
				"database" => $this->_config->db_name,
				"driver"   => $this->_config->db_driver,
				"prefix"   => $this->_config->db_prefix,
				);

			$db = Database::getInstance($connection_opts);

			return $db;
		}

		public function getTheme(){
			$theme = $this->getConfig()->theme;

			if(false === is_readable(BASE ."/app/themes/". $theme)){
				throw new Error(sprintf("Invalid theme chosen: <strong>%s</strong>", BASE ."/app/themes/". $theme));
			}else {
				return $theme;
			}
		}

		public function initialize($environment = "site"){
			$exec = null;

			switch($environment){
				case "cli":
					$exec = CLIApplication::getInstance();

				default:
				case "site":
					$exec = SiteApplication::getInstance();
					break;
			}

			try{
				$exec->go();
			}catch(Error $e){
				echo $e->getMessage();
			}

			return $exec;
		}

		public function setTitle($new_title = null){
			$title = "Default Page :: Anthem Forum";

			if(false === is_null($new_title)){
				$title = $new_title;
			}

			$this->_title = $title;

			return $title;
		}

		public function getTitle(){
			return $this->_title;
		}

		//stub for future functionality
		public function redirect($location = "/", $code = 404){
			return header(sprintf("Location:%s", $location), true, $code);
		}

		public function toString(){
			return get_class($this);
		}

		public static function getInstance(){
			if(false === self::$_instance instanceof self){
				$class = __CLASS__;
				
				self::$_instance = new $class;
			}
			
			return self::$_instance;
		}
	}

?>