<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <?php
        require "favicon.phtml";
    ?>
    <link rel="stylesheet" href="../css/authentication.css">
    <title>Login</title>
</head>
<body>
<?php
$con = mysqli_connect("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das");
session_start();
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $query    = "SELECT * FROM tx_users WHERE username='$username'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: dash");
    } else {
        echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'><a href='login'>Click here to Login again.</a></p>
                  </div>";
    }
} else {
    ?>
    <form class="form" method="post" name="login" autocomplete="off">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autocomplete="off" >
        <input type="password" class="login-input" name="password" placeholder="Password" autocomplete="off">
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">New to the Page?  <a href="register">Register</a></p>
    </form>
    <?php
}
?>
</body>
</html>