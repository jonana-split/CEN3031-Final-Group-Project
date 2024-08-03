#!/usr/local/bin/php
<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}

define('__HEADER_FOOTER_PHP__', true);


$data=mysqli_connect($host,$user,$password,$db);

$username = $_SESSION['username'];
$sql="SELECT * FROM tickets WHERE employeeid='".$username."'";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>employeeHome</title>
</head>


<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="employeeHome.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="employeeHome.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">Log Time Estimate</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">Log Hours</a></li>

        <li class="nav-item" ><a class="nav-link" href="calendar.php" style="color: aliceblue; ">View Calendar</a></li>

        <!--    TOOK THIS FROM CODE I WROTE IN A PREVIOUS PROJECT, have to edit it. JUST PROOF OF CONCEPT HERE -->
        <?php if (isset($_SESSION['username'])): ?>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?>'s Account
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" style = "color: #1C5E33" href="<?php echo "user_viewTickets.php" ?>">Dashboard</a></li>
                    <li><a class="dropdown-item" style = "color: #1C5E33" href="<?php echo "logout.php" ?>">LogOut</a></li>
                </ul>
            </div>
        <?php else: ?>
            <li class="nav-item" ><a class="nav-link rounded" href="<?php echo "login.php" ?>" style = "color: #174142; border: 2px solid #3f7778;  display: inline-block; background-color: #f0f8ff; padding: 5px"> Login</a></li>
        <?php endif; ?>

    </ul>
</nav>

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142;">
    <h3>Access all your tickets</h3>
    <p style="text-align: center"><a href="calendar.php">Calendar</a></p>
</div>

<br>
<hr style="width: 50%; margin: auto; background-color: #3f7778">

<div class="row" style="margin: 30px">
    <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
        <h5>Log Ticket Hours</h5>
        <h4>Input Hours</h4>
        <form class="white" action="logHours.php" method="POST">
                <input type="text" name="loggedHours" /><br><br>
                <select name="ticketLog">
                    <?php
                    $fetch_tickets=mysqli_query($data,$sql);
                    while($result = mysqli_fetch_array($fetch_tickets)){
                        ?>
                        <option value="<?php echo$result['id'] ?>"><?php echo $result['id'] ?></option>
                    <?php } ?>
                </select>
                <div class="center">
                    <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
                </div>
        </form>
    </div>
    <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
        <h5>Create Time Estimates</h5>
        <h4>Input Hours</h4>
        <form class="white" action="logEstimate.php" method="POST">
            <input type="text" name="estimateHours" /><br><br>
            <select name="ticketEstimate">
                <?php
                $fetch_tickets=mysqli_query($data,$sql);
                while($result = mysqli_fetch_array($fetch_tickets)){
                    ?>
                    <option value="<?php echo$result['id'] ?>"><?php echo $result['id'] ?></option>
                <?php } ?>
            </select>
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </div>
</div>


<!-- <hr style="width: 75%; margin: auto; background-color: #3f7778">
-->

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">
    <a href="logout.php"> Logout :D </a>

</div>

<br>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>
