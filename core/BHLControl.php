<?php

namespace BHLst\core;

use BHLst\database\Database;


if(!defined("AccPoint")) exit("Access denied");

class Studio {

    private $_config;


    public function __construct(){

    }

    public function setConfig( $config ){
        $this->_config = $config;
    }

    public function loadHelpers(){
        $helpers = $this->_config['load']['helpers'];

        for($i = 0; $i < count($helpers); $i++){
            $pathHelperCore = "core/helpers/".$helpers[$i].".php";
            $pathHelperApp  = "application/helpers/".$helpers[$i].'.php';

            if( file_exists($pathHelperCore) ) 
                    require_once($pathHelperCore);
            elseif( file_exists($pathHelperApp) )
                    require_once($pathHelperApp);
        }
    }
    
    public function loadControllers(){
        require_once("core/controllers/Controller.php");
        require_once("application/controllers/MainController.php");
        for($i = 0; $i < count($this->_config['load']['controllers']); $i++){
            $pathControllerApp  = "application/controllers/".$this->_config['load']['controllers'][$i].'.php';            
            if( file_exists($pathControllerApp) )
                   require_once($pathControllerApp);
        }
    }

    public function loadDataBase(){
        $db = new Database();

        $db->setHost($this->_config["DataBase"]['host']);
        $db->setPort($this->_config["DataBase"]['port']);
        $db->setUsername($this->_config["DataBase"]['username']);
        $db->setPassword($this->_config["DataBase"]['password']);
        $db->setCharset($this->_config["DataBase"]['charset']);
        $db->setDatabase($this->_config["DataBase"]['Base']);

        $db->init();
        $GLOBALS['db'] = $db;

    }

}

?>