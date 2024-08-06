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

if($row["usertype"]=="employee"){
    header("location:employeehome.php");
}

if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
$data = mysqli_connect($host, $user, $password, $db);

// Fetch active tickets
$active_tickets_query = "SELECT * FROM tickets WHERE user = '$user' AND status != 'closed'";
$active_tickets_result = $data->query($active_tickets_query);

// Fetch ticket history
$ticket_history_query = "SELECT * FROM tickets WHERE user = '$user' AND status = 'closed'";
$ticket_history_result = $data->query($ticket_history_query);

// Fetch chat history
//$chat_history_query = "SELECT * FROM chats WHERE from_user = '$user'";
//$chat_history_result = $data->query($chat_history_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>User Home</title>
</head>

<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="userhome.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="userhome.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="ticketCreation.php" style="color: aliceblue; ">Create Ticket</a></li>

        <li class="nav-item" ><a class="nav-link" href="user_dash.php" style="color: aliceblue; ">View History</a></li>

        <li class="nav-item" ><a class="nav-link" href="u_livechat.php" style="color: aliceblue; ">Live Chat</a></li>

        <li class="nav-item" ><a class="nav-link" href="logout.php" style="color: #98d8da; ">Logout <?php echo $_SESSION['username'] ?></a></li>

    </ul>
</nav>

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">
    <h3>Hello,<b> <?php echo $_SESSION['username'] ?></b></h3>
    <br>
    <hr style="width: 50%; margin: auto; background-color: #3f7778">
    <br>
    <h4>Welcome to iTicket:</h4>
    <h5>The solution to all of your IT ticketing needs!</h5>

    <!-- Links to different user features -->
    <div class="row" style="margin: 30px">
        <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
            <br>
            <h5>Have an issue you need fixed?</h5>
            <h4>Submit an IT ticket below</h4>
            <br>
            <button onclick="location.href='ticketCreation.php'" class="button rounded" style = "color: #5e979a; border: 2px solid #5e979a;  display: inline-block; padding: 5px">Create Ticket</button>
            <br>
            <br>
        </div>
        <div class="col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px; padding: 10px; background-color: #d2eeef">
            <br>
            <h5>Have any questions before submitting a ticket?</h5>
            <h4>Live Chat with an employee here</h4>
            <br>
            <button onclick="location.href='u_livechat.php'" class="button rounded" style = "color: #5e979a; border: 2px solid #5e979a;  display: inline-block; padding: 5px">Live Chat</button>
            <br>
            <br>
        </div>
    </div>

    <div class="w-50 col-md justify-content-center text-center rounded" style="color: #174142; border: #5e979a solid 1px;margin: 10px auto; padding: 10px; background-color: #d2eeef">
        <br>
        <h5>Want to view or discussing your past and current tickets?</h5>
        <h4>View your ticket history</h4>
        <br>
        <button onclick="location.href='user_dash.php'" class="button rounded" style = "color: #5e979a; border: 2px solid #5e979a;  display: inline-block; padding: 5px">Ticket History</button>
        <br>
        <br>
    </div>

    <br>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>