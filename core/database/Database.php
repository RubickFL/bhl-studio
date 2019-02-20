<?php
    namespace BHLst\database;

    use BHLst\database\ActiveRecord;

    if(!defined("AccPoint")) exit("ACCES DENIED");

    class Database extends ActiveRecord {

        private $_host;
        private $_port;
        private $_username;
        private $_password;
        private $_database;
        private $_charset;

        private $_pdo;

        public function __construct(){
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

        public function init(){
            $this->_pdo = new \PDO('mysql:host='.$this->_host.':'.$this->_port 
            . ';dbname='.$this->_database
            . ';charset=' . $this->_charset,
            $this->_username,$this->_password);
        }

        public function exec($query,$prepare){
           $statement =  $this->_pdo->prepare($query);

           for($i = 0; $i < count($prepare); $i++){
            $statement->bindParam($prepare[$i]['key'],$prepare[$i]['value']);
           }

           $statement->execute();
           return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }

    }
?>