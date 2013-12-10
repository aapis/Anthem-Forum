<?php

	abstract class Unit {
		public static function eq($cond1, $cond2){
			$comp = ($cond1 == $cond2);
			
			if(ANTHEM_DEV){
				$logger = Logger::getInstance();
				$logger_output = sprintf("[%s:%s] %s::%s == %s", __FILE__, __LINE__, __CLASS__, __FUNCTION__, ($comp ? "boolean(true) " : "boolean(false) "));

				$logger->record($logger_output);
			}

			return $comp;
		}

		public static function set($cond){
			$comp = isset($cond);

			if(ANTHEM_DEV){
				$logger = Logger::getInstance();
				$logger_output = sprintf("[%s:%s] %s::%s == %s", __FILE__, __LINE__, __CLASS__, __FUNCTION__, ($comp ? "boolean(true) " : "boolean(false) "));

				$logger->record($logger_output);
			}

			return $comp;
		}
	}

?>