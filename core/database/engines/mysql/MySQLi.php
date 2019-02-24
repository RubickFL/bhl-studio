<?php
    namespace BHLst\database\mysql;

    use BHLst\database\BaseDefinition;

    if(!defined("AccPoint")) exit("ACCES DENIED");

    class MySql extends BaseDefinition {

        private $_dbconnect;

        public function __construct(){
            parent::__construct();
        }

        public function init(){
            $this->_dbconnect = mysqli_connect( $this->_host . ':' . $this->_port, $this->_username, $this->_password, $this->_database );

            if(mysqli_connect_error()){

            }

            mysqli_set_charset( $this->_dbconnect, $this->_charset );
        }

        public function exec($query,$prepare){
            $result = array();
            for($i = 0; $i < count($prepare); $i++){
                $value = $this->stringForSql($prepare[$i]['value']);
                $query = str_replace($prepare[$i]['key'], '\'' . $value . '\'', $query);
            }
  
            $this->clear();
  
            $rows =  mysqli_query( $this->_dbconnect, $query );
            if(!is_bool($rows) && $rows !== 1)
                while($row = mysqli_fetch_assoc($rows)) $result[] = $row;
  
            return $result;
        }

        private function stringForSql($sql){
                $sql = trim($sql);
                if(get_magic_quotes_gpc() == 1)
                    $sql = stripslashes($sql);
                
              return  mysqli_real_escape_string($this->_dbconnect, $sql);
        }

    }
?>