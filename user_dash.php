#!/usr/local/bin/php

<?php
$host = "127.0.0.1";
$user_ = "root";
$password = "";
$db="login_it";
session_start();

if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
$data = mysqli_connect($host, $user_, $password, $db);

$username = $_SESSION["username"];

// Fetch active tickets
$active_tickets_query = "SELECT * FROM tickets WHERE tickets.user = '$username' AND status != 'closed'";
$active_tickets_result = $data->query($active_tickets_query);

// Fetch ticket history
$ticket_history_query = "SELECT * FROM tickets WHERE tickets.user = '$username' AND status = 'closed'";
$ticket_history_result = $data->query($ticket_history_query);

// Fetch chat history
$chat_history_query = "SELECT * FROM chats WHERE from_user = '$username'";
$chat_history_result = $data->query($chat_history_query);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>User History</title>

    <style>
        table, th, td, tr{
            border: #3f7778 solid 1px;
        }

        th{
            background-color: #acd8da;
        }
    </style>

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


<!--custom link based on ticket-->
<!-- https://www.sitepoint.com/community/t/a-href-link-with-id/31080/2 -->

<div class="section justify-content-center text-center" style="margin: 30px; color: #174142">

    <h3 style="text-align: center; color: #3f7778">User Dashboard</h3>
    <br>

    <h4>Welcome, <?php echo $_SESSION['username'] ?> !</h4>
    <br>

    <hr style="margin: auto; background-color: #3f7778">
    <br>

    <h5><b>Active Tickets</b></h5>
    <?php
    if ($active_tickets_result->num_rows > 0) {
        echo "<table class='table'>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Messages</th>
                  </tr>";
        while ($row = $active_tickets_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>" . $row["status"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td><button onclick=\"location.href='u_asynchChat.php?id=".$row['id']."&employeeid=".$row['employeeid']."'\">Chat</button></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No active tickets found.</p>";
    }
    ?>
    <br>
    <hr style="margin: auto; background-color: #3f7778">
    <br>

    <h5><b>Ticket History</b></h5>
    <br>

    <?php
    if ($ticket_history_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Type</th><th>Description</th><th>Status</th><th>Date</th></tr>";
        while ($row = $ticket_history_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>" . $row["status"] . "</td>
                    <td>" . $row["date"] . "</td>
                    </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No ticket history found.</p>";
    }
    ?>
    <br>
    <hr style="margin: auto; background-color: #3f7778">
    <br>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>
