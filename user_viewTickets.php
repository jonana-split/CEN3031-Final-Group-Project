#!/usr/local/bin/php
<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();
define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}


$data = mysqli_connect($host, $user, $password, $db);

$sql_chats = "SELECT chats.id, chats.to_user, chats.from_user, chats.time, chats.ticket_id, chats.body, chats.subject FROM chats";
$result_chats = $data->query($sql_chats);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>View Tickets</title>

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

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: #98d8da; "><?php echo $_SESSION['username'] ?>'s Account</a></li>

    </ul>
</nav>

<!-- PAGE FOR EACH TICKET -->
<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">
    <h3>View Tickets</h3>

    <button onclick="location.href='asynchChat_User.php?id=id'" class="button rounded" style = "color: #3f7778;border: 2px solid #5e979a;  display: inline-block; padding: 5px; " >Chat</button>

    <br>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>


