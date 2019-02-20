<?php
	namespace BHLst\controllers;

	if(!defined("AccPoint")) exit("ACCESS DENIED");
	
	use BHLst\controllers\MainController;
	use BHLst\helper\CustomHelper;

	class HomeController extends MainController {

		public function __constuct(){
			parent::__constuct();
			//$this->loadModel("Custom",'custom');
		}

		public function titleModule(){
			return false;
		}

		public function index(){
			echo "Hello World";
		}

		public function about(){
			$this->data('var','contAD');
			$this->display('about');
		}

		public function info($a){
			$this->loadModel('User','user');

			$user = $this->user->get();

			$this->data('user',$user);
			$this->data('var',$a);
			$this->display('info');
		}

	}
?>