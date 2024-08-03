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
$chat_history_query = "SELECT * FROM chats WHERE from_user = '$user'";
$chat_history_result = $data->query($chat_history_query);

$sql_tickets = "SELECT tickets.id, tickets.type, tickets.description, tickets.user, tickets.date, tickets.status 
        FROM tickets";
$result_tickets = $data->query($sql_tickets);

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

        <li class="nav-item" ><a class="nav-link" href="user_viewTickets.php" style="color: aliceblue; ">View Past Tickets</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: #98d8da; "><?php echo $_SESSION['username'] ?>'s Account</a></li>

    </ul>
</nav>

<div class="section">
    <h3 style="text-align: center; color: #3f7778">User Dashboard</h3>
    <h4>Welcome, <?php echo $_SESSION['username'] ?> !</h4>
    <hr>
    <h5>Active Tickets</h5>
    <?php
    if ($active_tickets_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Type</th><th>Description</th><th>Status</th><th>Date</th></tr>";
        while ($row = $active_tickets_result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["type"] . "</td><td>" . $row["description"] . "</td><td>" . $row["status"] . "</td><td>" . $row["date"] . "</td><td><button onclick=\"location.href='asynchChat_User.php?id=".$row['id']."'\">Chat</button></td></tr>";

        }
        echo "</table>";
    } else {
        echo "<p>No active tickets found.</p>";
    }
    ?>
    <hr>

    <h5>Ticket History</h5>
    <?php
    if ($ticket_history_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Type</th><th>Description</th><th>Status</th><th>Date</th></tr>";
        while ($row = $ticket_history_result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["type"] . "</td><td>" . $row["description"] . "</td><td>" . $row["status"] . "</td><td>" . $row["date"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No ticket history found.</p>";
    }
    ?>
    <hr>

    <h5>Chat History</h5>

    <?php



    /*if ($chat_history_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Message</th><th>Date</th></tr>";
        while ($row = $chat_history_result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["message"] . "</td><td>" . $row["date"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No chat history found.</p>";
    }
    */
    ?>
</div>

</body>

</html>
