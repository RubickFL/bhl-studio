<?php
    namespace BHLst\database\mysql;

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