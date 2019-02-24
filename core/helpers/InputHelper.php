<?php

namespace BHLst\helpers;

if(!defined("AccPoint")) exit('ACCESS DENIED');

class InputHelper {
    private function __construct() {

    }

    public static function input($value, $type = 'string', $isHtml = false ){
        $value = trim($value);

        switch($type){
            case 'int' : $value = intval($value);break;
            case 'string' : $value = strval($value);break;
            case 'float' : $value = floatval($value);break;
            case 'double': $value = floatval($value);break;
            default : $value = strval($value);break;

        }

        if( $isHtml )
            $value = htmlentities($value, ENT_QUOTES);

        return $value;

    }
}

?>