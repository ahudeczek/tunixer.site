<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <?php
        require "favicon.phtml";
    ?>
    <link rel="stylesheet" href="../css/authentication.css">
</head>
<body>
<?php
$con = mysqli_connect("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das");
// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $query    = "INSERT into tx_users (username, password)
                     VALUES ('$username', '" . md5($password) . "')";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login'>Login</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register'>registration</a> again.</p>
                  </div>";
    }
} else {
    ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Register</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required autocomplete="off">
        <input type="password" class="login-input" name="password" placeholder="Password" autocomplete="off">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login">Click to Login</a></p>
    </form>
    <?php
}
?>
</body>
</html>