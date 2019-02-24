<?php

namespace BHLst\models;

if(!defined("AccPoint")) exit("Access denied");

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