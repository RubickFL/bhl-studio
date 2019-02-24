
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