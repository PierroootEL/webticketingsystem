<?php


define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'Vatorea9nsoncerodall!');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'ticket');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);


$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);