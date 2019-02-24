<?php

namespace BHLst\routes;

use BHLst\helpers\HttpHelper;

if(!defined("AccPoint")) exit("Access denied");

class Route {

    private $_config;

    public function __construct() {}

    public function setConfig($config) {
        $this->_config = $config;
    }        

    public function load(){
        $segments = HttpHelper::getSegments();
        $segmentStr = implode('/',$segments);

        for($i = 0; $i < count($this->_config); $i++){
            if($_SERVER['REQUEST_METHOD'] == $this->_config[$i]['method']){
                $uri = trim($this->_config[$i]['uri'],'/');

                if(count($segments) !== substr_count($uri,'/')+1) 
                    continue;

                $uri = str_replace('#', '(.+)', $uri);
                preg_match('#^'.$uri.'^$#',$segmentStr);
                
                if(preg_match('#^'.$uri.'$#',$segmentStr )) {
                    for($j = 0; $j < count($this->_config[$i]['regex']); $j++){
                       $segment = $segments[$this->_config[$i]['regex'][$j]['segment']];
                       $rule = $this->_config[$i]['regex'][$j]['rule'];
                       if(preg_match($rule,$segment) ==  0)
                           continue 2;
                    }
                
                    $run = trim($this->_config[$i]['run'],'/');
                    if(strpos($run,'$') !==  false)
                        $run = preg_replace('#^'.$uri.'$#',$run,$segmentStr);

                    return $this->loadController($run,$this->_config[$i]['module']);
                }

            }
        }

        return false;
    }

    public function loadController($controllerData,$isModule){
        $data = explode('/',$controllerData);
        //print_r($data);

        $pathController = '';
        $titleController = '';
        $titleMethod = ''; 


        if($isModule) {
            $pathController = 'application/modules/'.$data[0].'/controllers/'.$data[1].'.php';
            $titleController = '\\BHLst\\'.$data[0].'\\controllers\\'.$data[1];
            $titleMethod = $data[2];

            unset($data[0]);
            unset($data[1]);
            unset($data[2]);
        }else{
            $pathController = 'application/controllers/'.$data[0].'.php';
            $titleController = 'BHLst\\controllers\\'.$data[0];
            $titleMethod = $data[1];

            unset($data[0]);
            unset($data[1]);
        }

        $params = array_values($data);

        if(file_exists($pathController))
            require_once($pathController); 

        if(class_exists($titleController) && method_exists($titleController,$titleMethod)) {
            $customController = new $titleController();
            call_user_func_array(array($customController,$titleMethod),$params);
            
            return true;
        }    

        return false;
    }


}

?>