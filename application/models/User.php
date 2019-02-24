<?php
    namespace BHLst\models;

    use BHLst\models\Model;

    
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

    class User extends Model{

        private $_table = 'users';

        public function __construct(){
            parent::__construct();
        }

        public function get(){
            $this->db->delete();
            $this->db->from($this->_table);
            $this->db->condition('name',':name');

            $this->db->addPrepares(
                array(
                    array(
                        'key' => ':name',
                        'value' => 'test',
                    ),
                )
            );
            return $this->exec();
        }

        public function getByLogin($login){
            $this->db->select('pass');
            $this->db->from($this->_table);
            $this->db->condition('name',$login);
            return $this->exec();
        }
    }

?>