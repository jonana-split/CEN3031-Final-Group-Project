<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();
define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"]))
{
    header("location:adminhome.php");
}

// Function to check if user is an admin
//function isAdmin() {
//    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
//}
// Redirect if not admin
//if (!isAdmin()) {
//    header('Location: login.php');
//    exit();
//}
$data = mysqli_connect($host, $user, $password, $db);
//if ($data === false) {
//    //die("connection error");
//    die("Connection failed: " . mysqli_connect_error());
//}

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
// Fetch all tickets
$sql_tickets = "SELECT tickets.id, tickets.type, tickets.description, tickets.user, tickets.date, tickets.status 
        FROM tickets";
$result_tickets = $data->query($sql_tickets);

// Fetch ticket counts by status
$sql_new = "SELECT COUNT(*) AS total_new FROM tickets WHERE status = 'open'";
$result_new = $data->query($sql_new);
$total_new = $result_new->fetch_assoc()['total_new'];

$sql_in_process = "SELECT COUNT(*) AS total_in_process FROM tickets WHERE status = 'in-process'";
$result_in_process = $data->query($sql_in_process);
$total_in_process = $result_in_process->fetch_assoc()['total_in_process'];

$sql_on_hold = "SELECT COUNT(*) AS total_on_hold FROM tickets WHERE status = 'on-hold'";
$result_on_hold = $data->query($sql_on_hold);
$total_on_hold = $result_on_hold->fetch_assoc()['total_on_hold'];

$sql_resolved = "SELECT COUNT(*) AS total_resolved FROM tickets WHERE status = 'closed'";
$result_resolved = $data->query($sql_resolved);
$total_resolved = $result_resolved->fetch_assoc()['total_resolved'];

$sql_categories = "SELECT type FROM tickets";
$result_categories = $data->query($sql_categories);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        .stats {
            margin-bottom: 20px;
        }
        .stats div {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h1>Admin Dashboard</h1>
<div class="stats">
    <div>Total New Tickets: <?php echo $total_new; ?></div>
    <div>Total In-Process Tickets: <?php echo $total_in_process; ?></div>
    <div>Total On-Hold Tickets: <?php echo $total_on_hold; ?></div>
    <div>Total Tickets Resolved: <?php echo $total_resolved; ?></div>
</div>
<div class="ticket-management">
    <h2>Manage Tickets</h2>
    <?php
if ($result_tickets->num_rows > 0) {
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
    while ($row = $result_tickets->fetch_assoc()) {
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
</body>
</html>

<?php
// Close connection
$data->close();
?>
