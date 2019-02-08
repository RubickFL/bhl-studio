<?php

$config = array();

$config['DataBase']['host']  = '127.0.0.1';
$config['DataBase']['port']  = '3306';

$config['DataBase']['username'] = "root";
$config['DataBase']['password'] = "FacelessLegion312";

$config['DataBase']['Base']  =  'main';
$config['DataBase']['charset'] = 'utf8'; 

$config['load']['controllers'] = ['MainController']; //подгрузка контроллеров 

$config['load']['helpers']  = ['HttpHelper'];

$config['load']['libraries'] = [];

$config['route'][] = [
    'Url' => '',
    'Method' => '',
    'Run' => '',
    'Module' => '',
    'Regex' => array(),
];

?>