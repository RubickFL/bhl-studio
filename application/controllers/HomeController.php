<?php
	namespace BHLst\controllers;

	if(!defined("AccPoint")) exit("ACCESS DENIED");
	
	use BHLst\controllers\MainController;
	use BHLst\helpers\InputHelper;

	class HomeController extends MainController {


		public function __construct(){
			parent::__construct();
			$this->loadHelper('InputHelper');
			$this->loadModel('User','user');
		}

		public function info( $test ){
			echo "Hello World";
			$login = InputHelper::input($_GET['login']);
			$users = $this->user->getByLogin('"test"');
			$this->data('user',$users);
			$this->display('users');
		}

		public function about(){



		}
	}
?>