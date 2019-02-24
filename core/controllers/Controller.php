<?php 

namespace BHLst\controllers;



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

class Controller {

    private $_variables;


    public function __construct(){
        $this->_variables = array();
    }

    public function data($titleVariable,$valueVariable){
        $this->_variables[] = [
            'title' => $titleVariable,
            'value' => $valueVariable,
        ];

    }

    function loadModel($titleModel,$aliasModel){
        $titleModule = $this->titleModule();
        $pathModel = '';

        if($titleModule !== false){
            $pathModel ='application/modules/'.$titleModule.'/models/'.$titleModel.'.php';
            $titleModel = 'BHLst\\'.$titleModule.'\\models\\'.$titleModel;

        }else{
            $pathModel ='application/models/'.$titleModel.'.php';
            $titleModel = 'BHLst\\models\\'.$titleModel;

        }

        if(file_exists($pathModel)){
           require_once($pathModel);
           $this->$aliasModel = new $titleModel();
           return true;   
        }

        return false; 
    }

    function loadHelper($titleHelper){
        $pathCoreHelper = 'core/helpers/'.$titleHelper.'.php';
        $pathAppliacationHelper ='application/helpers/'.$titleHelper.'.php';

        if(file_exists($pathCoreHelper)){
           require_once($pathCoreHelper);
           return true;
        }elseif(file_exists($pathAppliacationHelper)){
           require_once($pathAppliacationHelper);
           return true;   
        }
    }

    function loadLibrary($titleLibrary,$aliasLibrary){
        $pathCoreLib = 'core/helpers/'.$titleLibrary.'.php';
        $pathAppHelper ='application/helpers/'.$titleLibrary.'.php';

        if(file_exists($pathCoreLib)){
           require_once($pathCoreLib);
           $titleLibrary = '\\BHLst\libraries\\'.$titleLibrary;
           $this->aliasLibrary = new $titleLibrary();
           return true;
        }elseif(file_exists($pathAppLib)){
           require_once($pathAppLib);
           $titleLibrary = '\\BHLst\libraries\\'.$titleLibrary;
           $this->aliasLibrary = new $titleLibrary();
           return true;   
        }
   }

    public function display($titleView){
       $titleModule =  $this->titleModule();

       for($i = 0; $i < count($this->_variables); $i++)
           ${$this->_variables[$i]['title']} = $this->_variables[$i]['value'];

        if($titleModule !== false){
            $pathView = 'application/modules/' . $titleModule . '/views/' . $titleView . '.php';
            if(file_exists($pathView))  {
                require_once($pathView); 
                return true;
            }

        }

        $pathView = 'application/views/' . $titleView . '.php';
        if(file_exists($pathView)){
            require_once($pathView);
            return true;
        }

        return false;
    }

}
?>