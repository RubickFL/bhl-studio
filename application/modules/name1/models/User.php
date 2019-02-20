<?php

namespace BHLst\name1\models;

use BHLst\models\Model;

class User extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        return "Module_Test";
    }

}

?>