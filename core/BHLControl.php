<?php

namespace BHLst\core;


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

        $db = null;

        switch ($this->_config['DataBase']['engine']) {
            case 'pdo':
                require_once("core/database/engines/Database.php");
                $db = new \BHLst\database\Database();
                $db->setEngine("mysql");
                break;
            
            case 'mysql':
                require_once("core/database/engines/mysql/MySQLi.php");
                $db = new \BHLst\database\mysql\MySql();                
                break;

            default:
                break;
        }


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