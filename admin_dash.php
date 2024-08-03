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
    <title>Admin Dashboard - View Tickets</title>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="adminhome.php">iTicket</a>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="adminhome.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">About</a></li>

        <li class="nav-item" ><a class="nav-link" href="adminCreate.php" style="color: aliceblue; ">Register Users</a></li>

        <li class="nav-item" ><a class="nav-link" href="admin_dash.php" style="color: aliceblue; ">View Tickets</a></li>

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
