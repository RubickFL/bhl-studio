<?php

namespace BHLst\models;


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

class Model{

    public function __construct(){
        if( isset($GLOBALS['db']) ){
            global $db;
            $this->db = $db;
        }
    }

    function exec(){
        $query =  $this->db->getSql();
        $prepare = $this->db->getPrepare();
        return $this->db->exec($query,$prepare);
    }
}

?>