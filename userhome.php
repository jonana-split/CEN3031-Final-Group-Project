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

    <title>iTicket</title>
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

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: #98d8da; "><?php echo $_SESSION['username'] ?>'s Account</a></li>

    </ul>
</nav>

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">
    <h5>Need to create an IT ticket?</h5>
    <h3>iTicket has you covered!</h3>
    <br>
    <!--    MAKE THIS ONLY ACCESSIBLE WHEN UR LOGGED IN -->
    <?php if (isset($_SESSION['username'])): ?>
        <p>
            Submit a ticket below to get a quick response from our IT team.
        </p>
        <br>
        <button>Create Ticket</button>
        <br>
        <br>
        <br>
        <p>Want to chat with us before creating a ticket?</p>
        <p>Use our LiveChat feature!</p>
        <br>
        <button>Live Chat</button>

    <?php endif; ?>

    <br>

    <a href="logout.php"> Logout :D </a>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>
