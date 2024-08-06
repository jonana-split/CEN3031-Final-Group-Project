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
define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
?>

<!-- Home page of administrators -->

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>adminHome</title>
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

<div class="section justify-content-center text-center" style="margin: 30px; color: #174142">

    <h3 style="text-align: center; color: #3f7778">Administrator Home</h3>
    <br>

    <h4>Welcome, <?php echo $_SESSION['username'] ?> !</h4>
    <br>

    <hr style="width: 50%; margin: auto; background-color: #3f7778">
    <br>


    <!-- Different options for admin actions -->
    <div class="row" style="margin: 30px">
        <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
            <br>
            <h5>To create new Users, Employees, or Administrators...</h5>
            <h4>Register Users Here</h4>
            <br>
            <button onclick="location.href='adminCreate.php'" class="button rounded" style = "color: #5e979a; border: 2px solid #5e979a;  display: inline-block; padding: 5px">Register Users</button>
            <br>
            <br>
        </div>
        <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
            <br>
            <h5>Want to manage tickets, users, and schedules?</h5>
            <h4>View your Administrator Dashboard</h4>
            <br>
            <button onclick="location.href='admin_dash.php'" class="button rounded" style = "color: #3f7778;border: 2px solid #5e979a;  display: inline-block; padding: 5px; " >View Dashboard</button>
            <br>
            <br>
        </div>
    </div>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>