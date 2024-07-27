<?php
session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}

if(empty($_POST["type"])){
    die("Ticket Type required");
}

if(empty($_POST["description"])){
    die("Description required");
}

$mysqli = require  __DIR__ . "/database.php";

$date=date("Y-m-d");
$sql= "INSERT INTO tickets (type, description, user, date, status) VALUES (?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: .$mysqli->error");
}

$stmt->bind_param("ssss", $_POST["type"], $_POST["description"], $_SESSION["username"], $date);

if($stmt->execute()){
    header("Location: userhome.php");
    exit;
}


?>
