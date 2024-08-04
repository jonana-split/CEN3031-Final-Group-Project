#!/usr/local/bin/php
<?php
session_start();
define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Register A User</title>

    <!-- MAKE STYLE SHEET -->
    <style>
        form {
            margin: 0 auto;
            width: 350px;
            background-color: aliceblue;
            border: 2px #3f7778 solid;
            padding: 20px;
        }


    </style>
</head>
<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="adminhome.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="adminhome.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="adminCreate.php" style="color: aliceblue; ">Register Users</a></li>

        <li class="nav-item" ><a class="nav-link" href="admin_dash.php" style="color: aliceblue; ">View Tickets</a></li>

        <li class="nav-item" ><a class="nav-link" href="logout.php" style="color: #98d8da; ">Logout <?php echo $_SESSION['username'] ?></a></li>

    </ul>
</nav>

<!-- CITE: https://www.youtube.com/watch?v=ShbHwaiyOps -->

<br>
<h3 style="text-align: center; color: #3f7778">Register Users</h3>
<br>
<p style="text-align: center; color: #3f7778; margin: 0"><b>Requirements:</b></p>
<p style="text-align: center; color: #3f7778; margin: 0">1) Username and Email must be unique</p>
<p style="text-align: center; color: #3f7778; margin: 0">2) Password is 8 or more characters long</p>
<p style="text-align: center; color: #3f7778; margin: 0">3) Password contains letters and numbers</p>

<br>
<form class="" action="createAdminOrEmployee.php" method="POST" novalidate>
    <div class="input-group">
        <label style="padding: 5px; margin: 5px;text-align: left; ">Username</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="text" id="username" name="username">
    </div>

    <div class="input-group" >
        <label style="padding: 5px; margin: 5px;text-align: left; ">Password</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="password" id="password" name="password">
    </div>

    <div class="input-group" >
        <label style="padding: 5px; margin: 5px;text-align: left; ">Confirm Password</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="password" id="passwordConfirm" name="passwordConfirm">
    </div>

    <div class="input-group" >
        <label style="padding: 5px; margin: 5px;text-align: left; ">Email</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="email" id="email" name="email">
    </div>

    <div>
        <label style="padding: 5px; margin: 5px;text-align: left; ">Account Type</label>
        <select style="padding: 5px; margin: 5px; width: 100%" id="userType" name="userType">
            <option value="admin">Administrator</option>
            <option value="employee">Employee</option>
            <option value="user">User</option>
        </select>
    </div>

    <br>

    <div class="input-group justify-content-center" >
        <button style="padding: 5px; margin: 5px; width: 40%;" type="submit" name="regAccount">Register User</button>
    </div>

    <br>
</form>

<br>
<br>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>

</body>
</html>
