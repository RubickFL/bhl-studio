<?php

namespace BHLst\helpers;

if(!defined("AccPoint")) exit("Access denied");

class HttpHelper {

    private function __construct(){}

    public function getSegments(){
        $segments = explode('?',$_SERVER['REQUEST_URI']);
        $segments = trim($segments[0],'/');

        return explode('/',$segments);
    }

    public static function fu(){
        return "Hello from HH";
    }    
}

?>