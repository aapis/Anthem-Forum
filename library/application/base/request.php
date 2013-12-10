<?php
	defined("ANTHEM_EXEC") or die;

	class Request {
		
		private $_controller;
		private $_method;
		private $_args;

		public function __construct(){
			$parts = explode('/',$_SERVER['REQUEST_URI']);
			$parts = array_filter($parts);

			$this->_args = (isset($parts[sizeof($parts)]) ? array($parts[sizeof($parts)]) : array());//(isset($parts[0])) ? $parts : array();
			$this->_controller = ($c = array_shift($parts))? $c: 'index';
			$this->_method = ($c = array_shift($parts))? $c: 'display';
		}

		public function getController(){
			return $this->_controller;
		}
		public function getMethod(){
			return $this->_method;
		}
		public function getArgs(){
			return $this->_args;
		}
	}
