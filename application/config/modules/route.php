<?php


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