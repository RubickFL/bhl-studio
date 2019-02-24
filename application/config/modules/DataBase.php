
<?php

    if(!defined("AccPoint")) exit("ACCESS DENIED");

    $config['DataBase']['is_used'] = true;

    $config['DataBase']['host']  = '127.0.0.1';
    $config['DataBase']['port'] = '3306';

    $config['DataBase']['username'] = "root";
    $config['DataBase']['password'] = "FacelessLegion312";
    $config['DataBase']['Base']  =  'main';
    
    $config['DataBase']['charset'] = 'utf8';
    $config['DataBase']['engine'] = 'mysql';
    $config['DataBase']['connect'] = 'mysql';
?>