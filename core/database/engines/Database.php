<?php
    namespace BHLst\database;

    use BHLst\database\BaseDefinition;

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