<?php

if(!defined("AccPoint")) exit("ACCES DENIED");

$config = array();

$config['DataBase']['is_used'] = true;

$config['DataBase']['host']  = '127.0.0.1';
$config['DataBase']['port']  = '3306';

$config['DataBase']['username'] = "root";
$config['DataBase']['password'] = "FacelessLegion312";

$config['DataBase']['Base']  =  'main';
$config['DataBase']['charset'] = 'utf8'; 

$config['load']['controllers'] = ['MainController']; //подгрузка контроллеров 

$config['load']['helpers']  = ['HttpHelper'];

$config['route'][] = [
    'uri' => '',
    'method' => 'GET',
    'run' => 'HomeController/about',
    'module' => false,
    'regex' => array(),
];

$config['route'][] = [
    'uri' => 'about/',
    'method' => 'GET',
    'run' => 'HomeController/about',
    'module' => false,
    'regex' => array(),
];

$config['route'][] = [
    'uri' => 'about/#/',
    'method' => 'GET',
    'run' => 'HomeController/info/$1',
    'module' => false,
    'regex' => [
       [ 
           'segment' => 1,
            'rule' => '/^[a-z]{3,8}$/', 
       ],

    ],
];

$config['route'][] = [
    'uri' => 'module/#/',
    'method' => 'GET',
    'run' => 'name1/HomeController/info/$1',
    'module' => true,
    'regex' => [
       [ 
           'segment' => 1,
            'rule' => '/^[a-z][1-9]{3,8}$/', 
       ],

    ],
];

?>