<?php
	defined("ANTHEM_EXEC") or die;
	
	/**
	 * Generic exception handling
	 */
	class Error extends Exception {
		
	}

	//TODO: move to own class
	class InvalidFileException extends Error {

	}
?>