<?php
	namespace BHLst\controllers;

	if(!defined("AccPoint")) exit("ACCESS DENIED");
	
	use BHLst\controllers\MainController;

	class ErrorController extends MainController {

		public function __constuct(){
			parent::__constuct();
		}

		public function titleModule(){
			return false;
		}

		public function status404(){
			header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
			$this->display('errors/404');
		}

		public function status403(){
			header( $_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
			$this->display('errors/403');
		}

	}
?>