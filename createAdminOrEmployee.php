#!/usr/local/bin/php

<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

$data=mysqli_connect($host,$user,$password,$db);

$username=$_SESSION['username'];

$sql="SELECT * FROM users WHERE username='".$username."'";

$result=mysqli_query($data,$sql);

$row=mysqli_fetch_array($result);

if($row["usertype"]=="user")
{
    header("location:userhome.php");
}else if($row["usertype"]=="employee"){
    header("location:employeehome.php");
}

//https://www.youtube.com/watch?v=5L9UhOnuos0

//validate username
if(empty($_POST["username"])){
    die("Username is required");
}

//validate email
if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Invalid email");
};

//validate password
if(strlen($_POST["password"]) < 8){
    die("Password must be at least 8 characters long");
}

//make sure password has a letter and a number
if(!preg_match("/[a-z]/i",$_POST["password"])){
    die("Password must contain at least one letter");
}

if(!preg_match("/[0-9]/",$_POST["password"])){
    die("Password must contain at least one number");
}

//make sure passwords match
if($_POST["password"] !== $_POST["passwordConfirm"]){
    die("Passwords do not match");
}

//hash the password and make it secure!!!!!
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

if($_POST["userType"] == "admin"){
    $usertype = "admin";
}elseif ($_POST["userType"] == "employee"){
    $usertype = "employee";
}elseif ($_POST["userType"] == "user"){
    $usertype = "user";
}

$sql= "INSERT INTO users (username, email, password_hash, usertype) VALUES (?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt -> prepare($sql)){
    die("SQL error: ".$mysqli->error);
}

$stmt->bind_param("ssss", $_POST["username"], $_POST["email"], $password_hash, $usertype);

//this doesn't work/ keep u logged in
if($stmt->execute()){
    header("Location: adminhome.php");
    exit;
}