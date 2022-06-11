<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="../css/authentication.css">
    <?php
        require "favicon.phtml";
    ?>
</head>
<body>
<div class="form">
    <p class="welcome">Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <p>You are now at user dashboard page.</p>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="home">Home Page</a></p>
    <?php
        if ($_SESSION["username"] === "admin"){ ?>
            <p><a href="users">Users</a></p>
            <p><a href="groups">Groups</a></p>
            <p><a href="songy">Songs</a></p>
            <p><a href="languages">Languages</a></p>
            <p><a href="genres">Genres</a></p>
    <?php } ?>
</div>
</body>
</html>