<?php

namespace BHLst\database;

use BHLst\database\ActiveRecord;


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

class BaseDefinition extends ActiveRecord {

    protected $_host;
    protected $_port;
    protected $_username;
    protected $_password;

    protected $_database;
    protected $_charset;

   

    public function __construct() {
        parent::__construct();
    }

    public function getHost(){
        return $this->_host;
    }

    public function setHost($host){
        $this->_host = $host;
    }

    public function getPort(){
        return $this->_port;
    }

    public function setPort($port){
        $this->_port = $port;
    }

    public function getUsername(){
        return $this->_username;
    }

    public function setUsername($username){
        $this->_username = $username;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function setPassword($password){
        $this->_password = $password;
    }

    public function getDatabase(){
        return $this->_database;
    }

    public function setDatabase($database){
        $this->_database = $database;
    }

    public function getCharset(){
        return $this->_charset;
    }

    public function setCharset($charset){
        $this->_charset = $charset;
    }

    public function getEngine(){
        return $this->_engine;
    }

}

?>