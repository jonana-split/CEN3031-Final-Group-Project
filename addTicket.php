<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}

if(empty($_POST["type"])){
    die("Ticket Type required");
}

if(empty($POST["description"])){
    die("Description required");
}

$mysqli = require  _DIR . "/database.php";

$data=mysqli_connect($host,$user,$password,$db);
$employee="employee";
$currentHours = 99999999999999999999999999999999999;
$ssql="SELECT * FROM users WHERE usertype='".$employee."'";
$fetch_employee=mysqli_query($data,$ssql);
/*
while($result = mysqli_fetch_array($fetch_employee)){
    if($result['hours'] < $currentHours){
        $employee=$result['username'];
        $currentHours=$result['hours'];
    }
}*/

$date=date("Y-m-d");
$status = "open";
$sql= "INSERT INTO tickets (type, description, user, date, status, employeeid) VALUES (?,?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: .$mysqli->error");
}

$stmt->bind_param("ssssss", $_POST["type"], $_POST["description"], $_SESSION["username"], $date, $status, $employee);

if($stmt->execute()){
    header("Location: userhome.php");
    exit;
}


?>