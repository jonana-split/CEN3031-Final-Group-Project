#!/usr/local/bin/php

<?php
session_start();
define('__HEADER_FOOTER_PHP__', true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>iTicket</title>

    <style>
        .button:{
            background-color: #d9f1f3;
        }
        .button:hover{
            background-color: #7cb4b5;
        }
    </style>

</head>

<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="index.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="index.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="login.php" style="color: aliceblue; ">Login</a></li>
    </ul>
</nav>

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142;">
    <h5>Need to create an IT ticket?</h5>
    <h3>iTicket has you covered!</h3>
</div>

<br>
<hr style="width: 50%; margin: auto; background-color: #3f7778">

<div class="row" style="margin: 30px">
    <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
        <h5>To access your account or create a ticket...</h5>
        <h4>Sign in here!</h4>
        <br>
        <button onclick="location.href='login.php'" class="button rounded" style = "color: #5e979a; border: 2px solid #5e979a;  display: inline-block; padding: 5px">Login</button>
    </div>
    <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
        <h5>Don't have an account?</h5>
        <h4>Register here!</h4>
        <br>
        <button onclick="location.href='register.php'" class="button rounded" style = "color: #3f7778;border: 2px solid #5e979a;  display: inline-block; padding: 5px; " >Register</button>
    </div>
</div>

<br>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>