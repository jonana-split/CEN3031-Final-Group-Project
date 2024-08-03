#!/usr/local/bin/php
<?php
session_start();
define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"])) {
    header("location:login.php");
}

$host = "127.0.0.1";
$user = "root";
$password = "";
$db = "login_it";
$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details
$username = $_SESSION["username"];
$user_query = "SELECT * FROM users WHERE username = '$username'";
$user_result = $data->query($user_query);
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

// Fetch employee schedule
$schedule_query = "SELECT * FROM schedules WHERE user_id = '$user_id'";
$schedule_result = $data->query($schedule_query);

// Fetch assigned tickets
$assigned_tickets_query = "SELECT * FROM tickets WHERE assigned_to = '$username'";
$assigned_tickets_result = $data->query($assigned_tickets_query);

// Fetch chat history
$chat_history_query = "SELECT * FROM chats WHERE employee = '$username' OR user = '$username'";
$chat_history_result = $data->query($chat_history_query);

// Fetch logged hours
$logged_hours_query = "SELECT * FROM time_logs WHERE user_id = '$user_id'";
$logged_hours_result = $data->query($logged_hours_query);

// Handle ticket updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_ticket'])) {
    $ticket_id = intval($_POST['ticket_id']);
    $status = $data->real_escape_string($_POST['status']);
    $resolved_at = ($status === 'closed') ? 'NOW()' : 'NULL';
    $sql = "UPDATE tickets SET status = '$status', resolved_at = $resolved_at WHERE id = $ticket_id";
    if ($data->query($sql) === TRUE) {
        echo "Ticket updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $data->error;
    }
}

// Handle logging hours
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log_hours'])) {
    $ticket_id = intval($_POST['ticket_id']);
    $hours = floatval($_POST['hours']);
    $sql = "INSERT INTO time_logs (user_id, ticket_id, hours) VALUES ('$user_id', '$ticket_id', '$hours')";
    if ($data->query($sql) === TRUE) {
        echo "Hours logged successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $data->error;
    }
}

// Handle time estimates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estimate_time'])) {
    $ticket_id = intval($_POST['ticket_id']);
    $estimated_hours = floatval($_POST['estimated_hours']);
    $sql = "UPDATE tickets SET estimated_hours = '$estimated_hours' WHERE id = $ticket_id";
    if ($data->query($sql) === TRUE) {
        echo "Time estimate updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $data->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <title>Employee Dashboard</title>

    <style>
        .section {
            margin: 20px auto;
            width: 80%;
            background-color: aliceblue;
            border: 2px #3f7778 solid;
            padding: 20px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>

<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px; background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large" href="employee_dashboard.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style="background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="employee_dashboard.php" style="color: aliceblue;">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php" style="color: aliceblue;">Logout</a></li>
    </ul>
</nav>

<div class="section">
    <h3 style="text-align: center; color: #3f7778">Employee Dashboard</h3>
    <h4>Welcome, <?php echo $user['username']; ?>!</h4>
    <hr>

    <h5>Availability/Scheduling</h5>
    <div id="calendar"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    <?php
                    while ($row = $schedule_result->fetch_assoc()) {
                        echo "{title: 'Available', start: '" . $row['date'] . "'},";
                    }
                    ?>
                ]
            });
            calendar.render();
        });
    </script>
    <hr>

    <h5>Assigned Tickets</h5>
    <?php
    if ($assigned_tickets_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Type</th><th>Description</th><th>Status</th><th>Priority</th><th>Update Status</th><th>Log Hours</th><th>Time Estimate</th></tr>";
        while ($row = $assigned_tickets_result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["type"] . "</td><td>" . $row["description"] . "</td><td>" . $row["status"] . "</td><td>" . $row["priority"] . "</td>
            <td>
                <form method='POST' action=''>
                    <input type='hidden' name='ticket_id' value='" . $row["id"] . "'>
                    <select name='status'>
                        <option value='open'" . ($row["status"] === 'open' ? ' selected' : '') . ">Open</option>
                        <option value='in-process'" . ($row["status"] === 'in-process' ? ' selected' : '') . ">In-Process</option>
                        <option value='on-hold'" . ($row["status"] === 'on-hold' ? ' selected' : '') . ">On-Hold</option>
                        <option value='closed'" . ($row["status"] === 'closed' ? ' selected' : '') . ">Resolved</option>
                    </select>
                    <button type='submit' name='update_ticket' class='btn btn-primary'>Update</button>
                </form>
            </td>
            <td>
                <form method='POST' action=''>
                    <input type='hidden' name='ticket_id' value='" . $row["id"] . "'>
                    <input type='number' name='hours' step='0.1' min='0' required>
                    <button type='submit' name='log_hours' class='btn btn-secondary'>Log Hours</button>
                </form>
            </td>
            <td>
                <form method='POST' action=''>
                    <input type='hidden' name='ticket_id' value='" . $row["id"] . "'>
                    <input type='number' name='estimated_hours' step='0.1' min='0' required value='" . $row["estimated_hours"] . "'>
                    <button type='submit' name='estimate_time' class='btn btn-info'>Estimate Time</button>
                </form>
            </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No assigned tickets found.</p>";
    }
    ?>
    <hr>

    <h5>Chat History</h5>
    <?php
    if ($chat_history_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>ID</th><th>Message</th><th>Date</th></tr>";
        while ($row = $chat_history_result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["message"] . "</td><td>" . $row["date"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No chat history found.</p>";
    }
    ?>
    <hr>

    <h5>Logged Hours</h5>
    <?php
    if ($logged_hours_result->num_rows > 0) {
        echo "<table class='table table-bordered'><tr><th>Ticket ID</th><th>Hours</th><th>Date Logged</th></tr>";
        while ($row = $logged_hours_result->fetch_assoc()) {
            echo "<tr><td>" . $row["ticket_id"] . "</td><td>" . $row["hours"] . "</td><td>" . $row["date_logged"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No logged hours found.</p>";
    }
    ?>
</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">
    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>
</footer>

</body>
</html>
