<?php
    namespace BHLst\database;

    use BHLst\database\BaseDefinition;

    if(!defined("AccPoint")) exit("ACCES DENIED");

    class Database extends BaseDefinition {

        private $_engine;
        private $_pdo;

        public function __construct(){
            parent::__construct();
        }


        public function init(){
            $this->_pdo = new \PDO($this->_engine . ':host=' . $this->_host . ':' . $this->_port 
            . ';dbname='.$this->_database
            . ';charset=' . $this->_charset,
            $this->_username,$this->_password);
        }

        public function exec($query,$prepare){echo "pdo:" . $query; exit();
           $statement =  $this->_pdo->prepare($query); 

           for($i = 0; $i < count($prepare); $i++){
            $statement->bindParam($prepare[$i]['key'],$prepare[$i]['value']);
           }

           $this->clear();
           
           $statement->execute();
           return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }


        public function setEngine($engine){
            $this->_engine = $engine;
        }

    }
?>