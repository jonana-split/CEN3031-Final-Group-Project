<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}

if(empty($_POST["loggedHours"])){
    die("The number of hours worked is required");
}

if(empty($_POST["ticketLog"])){
    die("The ticket you worked on is required");
}

//update the number of hours within the tickets table
$mysqli = require  __DIR__ . "/database.php";
$data=mysqli_connect($host,$user,$password,$db);

$sql = "UPDATE tickets SET logged_hours=$_POST[loggedHours] WHERE id=$_POST[ticketLog]";

if ($data->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $data->error;
}


?>
