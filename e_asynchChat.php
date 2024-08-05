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

if($row["usertype"]=="user")
{
    header("location:userhome.php");
}

define('__HEADER_FOOTER_PHP__', true);
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}

$data = mysqli_connect($host, $user, $password, $db);

//test when id=1
//MAKE SURE TO CHANGE THIS TO 'id'

$ticket_id = $_GET["id"];
$user = $_GET["user"];

//https://learnsql.com/cookbook/how-to-order-by-date-in-mysql/#:~:text=Use%20the%20ORDER%20BY%20keyword,shown%20last%2C%20etc.).

$sql_chats = "SELECT chats.id, chats.to_user, chats.from_user, chats.time, chats.body, chats.subject FROM chats WHERE chats.ticket_id='$ticket_id' ORDER BY chats.id DESC";

$result_chats = $data->query($sql_chats);

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
    <a style="text-decoration: none; color: aliceblue; font-size: xx-large " href="employeeHome.php">iTicket</a>
</div>
<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="employeeHome.php" style="color: aliceblue; ">Home</a></li>

        <li class="nav-item" ><a class="nav-link" href="calendar.php" style="color: aliceblue; ">View Calendar</a></li>

        <li class="nav-item" ><a class="nav-link" href="e_livechat.php" style="color: aliceblue; ">Live Chat</a></li>

        <li class="nav-item" ><a class="nav-link" href="logout.php" style="color: #98d8da; ">Logout <?php echo $_SESSION['username'] ?></a></li>

    </ul>
</nav>


<div class="justify-content-center text-center" style="margin-top: 50px; color: #174142">

    <!--
    https://stackoverflow.com/questions/26924762/assigning-variables-to-sql-query-result
    https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp
    https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html
    -->


    <section class="container grey-text">
        <h4 class="center">Chat with:<b> <?php echo $user; ?></b></h4>
        <p class="center">Regarding ticket ID: <b> <?php echo $ticket_id; ?> </b></p>

        <form class="white" action="e_addChat.php?user=<?php echo $user; ?>&ticket_id=<?php echo $ticket_id; ?>" method="POST">
            <label style="display: inline-block; width: 100px; text-align: right;">Subject</label>
            <input type="text" name="subject">
            <br><br>
            <label style="display: inline-block; width: 100px; text-align: right;">Description</label>
            <input type="text" name="body">
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0 rounded" style = "color: #3f7778;border: 2px solid #5e979a;  display: inline-block; padding: 5px; ">
            </div>
        </form>
    </section>
    <br>
    <h4>Chat History:</h4>
    <?php
    if ($result_chats->num_rows > 0) {

        // Output data of each row
        while ($row = $result_chats->fetch_assoc()) {
            echo "
                <table class='center w-75' style='border: 1px solid black; margin-left: auto;margin-right: auto;'
                <tr>
                 <th style='border: 1px solid black; background-color: #88cacc' class='w-50'>To: " . $row["to_user"] . "</th>
                 <th style='border: 1px solid black; background-color: #88cacc' class='w-50'>From: " . $row["from_user"] . "</th>
                 </tr>
                 <tr>
                 <td colspan='2' style='border: 1px solid black;'> <b>Subject:</b> " . $row["subject"] . "</td>
                </tr>
                <tr>
                <td colspan='2' style='border: 1px solid black;'>" . $row["body"] . "</td>
                </tr>
                </table>
                <p style='font-size: 8pt'>" . $row["time"] . "</p>
                <br>
                
                ";

        }

    } else {
        echo "No chats found";
    }
    ?>

</div>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>
</body>

</html>

