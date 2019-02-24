<?php

	namespace BHLst\index;
	
	define("AccPoint",true);
	define("Access_Mode",'development');

	switch(Access_Mode){
		case 'development' :
			ini_set('error_reporting',E_ALL);
			ini_set('display_errors',1);
			ini_set('display_startup_errors',1);
		break;

		case 'production' :
			ini_set('error_reporting',~E_ALL);
			ini_set('display_errors','Off');
			ini_set('display_startup_errors','Off');
		break;
	}

	use BHLst\core\Studio;
	use BHLst\helpers\HttpHelper;
	use BHLst\routes\Route;

	require_once("core/BHLControl.php");
	require_once("core/route/Route.php");
	require_once("application/config/configs.php");
	require_once("core/models/Model.php");

	$proj = new Studio;
	$proj->setConfig($config);

	$proj->loadHelpers();
	$proj->loadControllers();

	HttpHelper::prepareGet();

	if($config['DataBase']['is_used']){
		require_once("core/database/ActiveRecord.php");
		require_once("core/database/BaseDefinition.php");
		$proj->loadDataBase();
	}

	$route = new Route();
	$route->setConfig($config["route"]);
	if(!$route->load()) HttpHelper::status404(); 


	exit;
?>
 