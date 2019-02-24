<?php
	namespace BHLst\controllers;

	
	if(!defined("AccPoint")) {
		$joke = ' <!DOCTYPE html>
		<html lang="en">
		<head>
			<title>410 Gone</title>
		</head>
		<body>
			<h1>Gone</h1>
			<p>The requested resource <br>
			'. $_SERVER["PHP_SELF"] . '
			<br> is no longer available on this server and there is no forwarding address.
			Please remove all references to this source. <br><br>
			Additionally, a 410 Gone error was encoutentered while trying to use an ErrorDocument to handle the request</p>
		</body>
		</html> ';
		header($_SERVER['SERVER_PROTOCOL'] . ' 410 Gone');
		exit($joke);
	}
	
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