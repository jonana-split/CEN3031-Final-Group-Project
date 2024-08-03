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

$sql_tickets = "SELECT chats.id, chats.to_user, chats.from_user, chats.time, chats.ticket_id FROM chats";
$result_chats = $data->query($sql_tickets);

?>

<!--Users-->

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Asynchronous Chat</title>
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

<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">

    <!-- adjust for chat updates -->

    <?php
    if ($result_chats->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Action</th>
                </tr>";
        // Output data of each row
        while ($row = $result_chats->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>" . $row["user"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["status"] . "</td>
                    <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='ticket_id' value='" . $row["id"] . "'>
                                <select name='status'>
                                    <option value='open'" . ($row["status"] === 'open' ? ' selected' : '') . ">Open</option>
                                    <option value='in-process'" . ($row["status"] === 'in-process' ? ' selected' : '') . ">In-Process</option>
                                    <option value='on-hold'" . ($row["status"] === 'on-hold' ? ' selected' : '') . ">On-Hold</option>
                                    <option value='closed'" . ($row["status"] === 'closed' ? ' selected' : '') . ">Resolved</option>
                                </select>
                                <button type='submit' name='update_ticket'>Update</button>
                            </form>
                        </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No tickets found";
    }
    ?>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>

