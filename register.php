<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$db="login_it";

session_start();

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    //die("connection error");
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $sql = "select * from user where username='" . $username . "'AND password='" . $password . "'";

    $result = mysqli_query($data, $sql);

    $row = mysqli_fetch_array($result);

    if ($row["usertype"] == "user") {
        $_SESSION["username"] = $username;
        header("location:userhome.php");
    } elseif ($row["usertype"] == "admin") {
        $_SESSION["username"] = $username;
        header("location:adminhome.php");
    } else {
        echo "username or password is incorrect";
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

    <title>Register for iTicket</title>

    <!-- MAKE STYLE SHEET -->
    <style>
        form {
            margin: 0 auto;
            width: 350px;
            background-color: aliceblue;
            border: 2px #3f7778 solid;
            padding: 20px;
        }


    </style>
</head>

<body style="font-family: K2D; background-color: #e0f2f3">

<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0; padding: 40px ;background-color: cadetblue; color: aliceblue">
    <h3>iTicket</h3>
</div>

<nav class="navbar navbar-expand-sm justify-content-center" style=" background-color: #3f7778; color: #f0f8ff">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">Create Ticket</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">About</a></li>

        <li class="nav-item" ><a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="color: aliceblue; ">Dashboard</a></li>

        <!--    TOOK THIS FROM CODE I WROTE IN A PREVIOUS PROJECT, have to edit it. JUST PROOF OF CONCEPT HERE -->
        <?php if (isset($_SESSION['user'])): ?>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?>'s Account
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" style = "color: #1C5E33" href="<?php echo "u_dashboard.php" ?>">Dashboard</a></li>
                    <li><a class="dropdown-item" style = "color: #1C5E33" href="<?php echo "logout.php" ?>">LogOut</a></li>
                </ul>
            </div>
        <?php else: ?>
            <li class="nav-item" ><a class="nav-link rounded" href="<?php echo "login.php" ?>" style = "color: #174142; border: 2px solid #3f7778;  display: inline-block; background-color: #f0f8ff; padding: 5px"> Login</a></li>
        <?php endif; ?>

    </ul>
</nav>

<!-- CITE and change up the styling here and above a little: https://www.youtube.com/watch?v=ShbHwaiyOps -->

<br>
<h3 style="text-align: center; color: #3f7778">Register</h3>
<form action="#" method="POST">
    <div>
        <label>username</label>
        <input type="text" name="username" required>
    </div>
    <br><br>

    <div>
        <label>password</label>
        <input type="password" name="password" required>
    </div>
    <br><br>

    <div>
        <input type="submit" value="Login">
    </div>

</form>
<!--<form class="" action="register.php"
    <div class="input-group">
        <label style="padding: 5px; margin: 5px;text-align: left; ">Username</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="text" name="user">
    </div>

    <div class="input-group" >
        <label style="padding: 5px; margin: 5px;text-align: left; ">Password</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="text" name="password">
    </div>

    <div class="input-group" >
        <label style="padding: 5px; margin: 5px;text-align: left; ">Email</label>
        <input style="padding: 5px; margin: 5px; width: 100%" type="text" name="email">
    </div>

    <br>

    <div class="input-group justify-content-center" >
        <button style="padding: 5px; margin: 5px; width: 40%;" type="submit" name="regAccount">Register</button>
    </div>
</form>-->

<br>

<footer class="text-center" style="background-color: #3f7778; color: #F0F8FFFF; padding: 15px">

    <p>&copy Debug Divas 2024</p>
    <p>CEN3031 Final Project</p>

</footer>

</body>
</html>
