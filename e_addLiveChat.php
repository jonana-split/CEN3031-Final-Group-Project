<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}

if(empty($_POST["body"])){
    die("Body required");
}

$mysqli = require  __DIR__ . "/database.php";

$data=mysqli_connect($host,$user,$password,$db);

$to_user= $_GET["user"];

$time=date("Y-m-d h:s:m");
$sql= "INSERT INTO livechats (to_user, from_user, time, body, subject) VALUES (?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: .$mysqli->error");
}

$stmt->bind_param("sssss", $to_user, $_SESSION["username"], $time, $_POST["body"], $_POST["subject"]);

if($stmt->execute()){
    header("Location: e_livechat.php?user=".$to_user);
    exit;
}


?>
