<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * Factory object
	 */
	class Application {
		public $config;

		private static $_instance;

		//instantiate the config class and expose certain properties
		public static function getConfig($properties = array()){
			$config = new Config(); //get config class from function properties?

			/*if(is_array($properties)){

			}

			if($config){
				$this->config = new Generic();

				foreach($config as $cfg){
					$this->config->set("db", new Generic());
					$this->config->db->set("name", $cfg->db_name);
					$this->config->db->set("user", $cfg->db_user);
					$this->config->db->set("host", $cfg->db_host);
					$this->config->db->set("password", $cfg->db_password);
				}
			}

			return $this->config;*/
			return $config;
		}

		public static function getUser(){

		}

		public function getTheme(){
			$theme = $this->getConfig()->theme;

			if(false === is_readable(BASE ."/app/themes/". $theme)){
				throw new Error(sprintf("Invalid theme chosen: <strong>%s</strong>", $theme));
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