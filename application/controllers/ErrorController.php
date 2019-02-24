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