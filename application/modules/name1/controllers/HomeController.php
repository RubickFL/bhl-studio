<?php
	namespace BHLst\name1\controllers;

	if(!defined("AccPoint")) exit("ACCESS DENIED");
	
	use BHLst\controllers\MainController;

	class HomeController extends MainController {

		public function __constuct(){
			parent::__construct();
		}

		public function index(){
			echo "Hello World";
		}

		public function about(){
			echo 'about';
		}

		function titleModule(){
			return 'name1';
		}

		public function info($a){
			echo "IT'S MODULE<br>";
			$this->loadModel('User','user');

			$user = $this->user->get();

			$this->data('user',$user);
			$this->data("var",$a);
			$this->display('about');
		}

	}
?>
