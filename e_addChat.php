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
$ticket_id = $_GET["ticket_id"];

$ssql="SELECT * FROM tickets WHERE tickets.user='".$to_user."'";
$fetch_employee=mysqli_query($data,$ssql);

$time=date("Y-m-d h:s:m");

//insert chat data into chats table
$sql= "INSERT INTO chats (to_user, from_user, time, ticket_id, body, subject) VALUES (?,?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: .$mysqli->error");
}

$stmt->bind_param("sssiss", $to_user, $_SESSION["username"], $time, $ticket_id, $_POST["body"], $_POST["subject"]);

if($stmt->execute()){
    header("Location: e_asynchChat.php?user=".$to_user."&id=".$ticket_id);
    exit;
}


?>
