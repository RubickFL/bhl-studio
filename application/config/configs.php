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

$config = array();

require_once('modules/DataBase.php');
require_once('modules/load.php');
require_once('modules/route.php');

?>