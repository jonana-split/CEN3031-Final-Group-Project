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

//get employee id and ticket id, so we can associate user, employee, and ticket
$to_user= $_GET["employeeid"];
$ticket_id = $_GET["ticket_id"];

//only use tickets associated with that employee and user
$ssql="SELECT * FROM tickets WHERE employeeid='".$to_user."'";
$fetch_employee=mysqli_query($data,$ssql);

//current time and date
$time=date("Y-m-d h:s:m");

//insert the chats
$sql= "INSERT INTO chats (to_user, from_user, time, ticket_id, body, subject) VALUES (?,?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: .$mysqli->error");
}

$stmt->bind_param("sssiss", $to_user, $_SESSION["username"], $time, $ticket_id, $_POST["body"], $_POST["subject"]);

//go back to asynchchat when done
if($stmt->execute()){
    header("Location: u_asynchChat.php?employeeid=".$to_user."&id=".$ticket_id);
    exit;
}


?>
