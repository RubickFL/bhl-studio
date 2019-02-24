<?php
	namespace BHLst\controllers;
	
	if(!defined("AccPoint")) exit("ACCESS DENIED");

	use BHLst\controllers\Controller;


	class MainController extends Controller {


		public function __construct(){
			parent::__construct();
			$this->var = "512";
		}

		public function titleModule(){
			return false;
		}
	}
?>
