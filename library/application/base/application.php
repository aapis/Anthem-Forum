<?php
	defined("ANTHEM_EXEC") or die;

	/**
	 * Factory object
	 */
	abstract class Application {
		public $config;

		//instantiate the config class and expose certain properties
		public function getConfig($properties){
			$config = new Config(); //get config class from function properties?

			if($config){
				$this->config = new Object();

				foreach($config as $cfg){
					$this->config->set("db", new Object());
					$this->config->db->set("name", $cfg->db_name);
					$this->config->db->set("user", $cfg->db_user);
					$this->config->db->set("host", $cfg->db_host);
					$this->config->db->set("password", $cfg->db_password);
				}
			}

			return $this->config;
		}

		public static function initialize($environment = "site"){
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
			}catch(Exception $e){
				$controller = new Error();
				echo $e->getMessage();
			}

			return $exec;
		}
	}

?>