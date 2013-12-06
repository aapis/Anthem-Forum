<?php
	defined("ANTHEM_EXEC") or die;
	
	abstract class Application {
		public static function execute($environment = "site"){
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
				$controller->error($e->getMessage());
			}

			return true;
		}
	}

?>