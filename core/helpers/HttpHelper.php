<?php

namespace BHLst\helpers;

use BHLst\routes\Route;


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

class HttpHelper {

    private function __construct(){
        $this->route = new Route;
    }

    public static function getProtocol(){
        if((!empty($_SERVER['HTTP']) && $_SERVER['HTTPS'] != 'off')
            || $_SERVER['SERVER_PORT'] == 443) return "https";

        return 'http';
    }

    public static function getDomain(){
        return $_SERVER['HTTP_HOST'];
    }

    public static function getSegments(){
        $segments = explode('?',$_SERVER['REQUEST_URI']);
        $segments = trim($segments[0],'/');

        return explode('/',$segments);
    }

    public static function prepareGet(){
        if( strpos($_SERVER['REQUEST_URI'],'?') !== false ){
            $request = explode('?',$_SERVER['REQUEST_URI']);
            $gets = array();
            parse_str($request[1],$gets);
            $_GET = $gets;
            unset($gets);
        }else{
            $_GET = array();
        }
    }

    public static function status404(){
        ob_start();
        $this->route->loadController('ErrorController/status404',false);
        exit();
    }

    public static function status403(){
        ob_start();
        $this->route->loadController('ErrorController/status403',false);
        exit();
    }

    
}

?>