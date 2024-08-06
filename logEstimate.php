<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}

if(empty($_POST["estimateHours"])){
    die("The forecasted amount of work is required");
}

if(empty($_POST["ticketEstimate"])){
    die("The ticket you worked on is required");
}

//update the time estimate within the tickets database
$mysqli = require  __DIR__ . "/database.php";
$data=mysqli_connect($host,$user,$password,$db);

$sql = "UPDATE tickets SET time_estimate=$_POST[estimateHours] WHERE id=$_POST[ticketEstimate]";

if ($data->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $data->error;
}


?>
