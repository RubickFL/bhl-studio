<?php

	namespace BHLst\index;
	
	define("AccPoint",true);

	use BHLst\core\Studio;
	use BHLst\helpers\HttpHelper;
	use BHLst\helpers\TestHelper;
	use BHLst\routes\Route;
	use BHLst\database\Database;

	require_once("application/config/configs.php");
	require_once("core/BHLControl.php");
	require_once("core/route/Route.php");
	require_once("core/models/Model.php");

	$proj = new Studio;
	$proj->setConfig($config);

	$proj->loadHelpers();
	$proj->loadControllers();
	if($config['DataBase']['is_used']){
		require_once("core/database/ActiveRecord.php");
		require_once("core/database/Database.php");
		$proj->loadDataBase();
	}

	$route = new Route();
	$route->setConfig($config["route"]);
	if(!$route->load()) exit('Error 404'); 

	//echo "<pre>"; print_r($config);

	exit;
?>
 