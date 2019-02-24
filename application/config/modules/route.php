<?php

    if(!defined("AccPoint")) exit("ACCESS DENIED");

    $config['route'][] = [
        'uri' => '',
        'method' => 'GET',
        'run' => 'HomeController/info',
        'module' => false,
        'regex' => array(),
    ];

    $config[] = [
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
                'rule' => '/^[a-z | 0-9]{5,10}$/', 
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