<!DOCTYPE html>
<html>

<head>
    <title>Debug Divas</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
<body class="grey lighten-4">
<nav class="white z-depth-0">
    <div class="container">
        <a href="#" class="brand-logo brand-text">Debug Divas</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="#" class="btn brand z-depth-0">Add a Ticket</a></li>
        </ul>
    </div>
</nav>

<section class="container grey-text">
    <h4 class="center">Add a Ticket</h4>
    <form class="white" action="addTicket.php" method="POST">
        <label>Ticket Type</label>
        <select name="type">
            <option value="">Choose an option</option>
            <option value="Hardware">Hardware</option>
            <option value="Software">Software</option>
            <option value="Network">Network</option>
        </select>
        <label>Description</label>
        <input type="text" name="description">
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<footer class="section">
    <div class="center grey-text"></div>
</footer>
</body>
</html>
