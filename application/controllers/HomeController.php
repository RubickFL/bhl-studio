<?php
	namespace controllers;

	use controllers\MainController;


	class HomeController extends MainController {

		public function __constuct(){
			parent::__constuct();
		}

		public function index(){
			echo "Hello World";
		}
	}
?>
