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

    $mysqli = require  __DIR__ . "/database.php";

    $username = $_SESSION["username"];

    $sql="SELECT * FROM tickets WHERE employeeid='".$username."'";
    $fetch_event=mysqli_query($data,$sql);
?>
<html>
<head>
    <title>Ticket Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <h2><center>Ticket Calendar</center></h2>
    <div class="container">
        <div id="calendar"></div>
    </div>
    <br>
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