<?php

$user = 'webapp';
$pass = 'webapp';

$dsn = 'mysql:host=mysql;dbname=webapp';
try{
    $dbh = new PDO($dsn, $user, $pass);
    echo '<p>Hello from ' . $_SERVER['HTTP_HOST'] . '<br />Successfully connected to DB!</p>';
} catch(Exception $exception) {
    echo '<p>Cannot Connect</p>';
    die($exception);
}