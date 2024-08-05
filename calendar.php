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

define('__HEADER_FOOTER_PHP__', true);

$data=mysqli_connect($host,$user,$password,$db);

$username = $_SESSION["username"];

$sql="SELECT * FROM tickets WHERE employeeid='".$username."'";
$fetch_event=mysqli_query($data,$sql);
?>
<html>
<head>
    <title>Ticket Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

<h1><center>Ticket Calendar</center></h1>
<br>
<div class="container">
    <div id="calendar"></div>
</div>
<br>


<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>

</body>
</html>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events:[
                <?php
                while($result = mysqli_fetch_array($fetch_event))
                { ?>
                {
                    title: '<?php echo $result['id']; ?>',
                    start: '<?php echo $result['date']; ?>',
                    end: '<?php echo $result['date']; ?>',
                    color: 'yellow',
                    textColor: 'black'
                },
                <?php } ?>
            ]
//This calendar was inspired by these two sources:
//https://codeshack.io/event-calendar-php/
//https://techareatutorials.com/how-to-fetch-events-from-the-database-in-javascript-fullcalendar/
        });
    });
</script>