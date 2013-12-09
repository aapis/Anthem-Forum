<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * Factory object
	 */
	class Application {
		private $_config;

		private static $_instance;

		public function __construct(){
			$this->_config = new Config();
		}

		//instantiate the config class and expose certain properties
		public function getConfig(){
			return $this->_config;
		}

		public function getUser(){

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

		//stub for future functionality
		public function redirect(){
			return true;
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