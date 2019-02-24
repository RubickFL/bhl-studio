<?php

    if(!defined("AccPoint")) exit("ACCESS DENIED");
    
    $config['load']['controllers'] = ['MainController']; //подгрузка контроллеров 
    
    $config['load']['helpers']  = ['HttpHelper'];

?>