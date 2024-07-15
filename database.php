#!/usr/local/bin/php

<?php

$host = "127.0.0.1";
$dbname = "login_it";
$username = "root";
//empty password for local development
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_errno){
    die("Connection error: ".$mysqli->connect_error);
}

return $mysqli;
