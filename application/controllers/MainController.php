<?php
	namespace BHLst\controllers;
	
	if(!defined("AccPoint")) exit("ACCESS DENIED");

	use BHLst\controllers\Controller;


	class MainController extends Controller {

		public function __constuct(){
			parent::__constuct();
		}

		public function index(){
			echo "Hello World";
		}
	}
?>
