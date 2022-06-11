<?php

session_start();

$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));

$username = "";
$password = "";
$update = false;
$id = 0;

if (isset($_POST["save"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = sha1($password);
    $mysqli->query("INSERT INTO tx_users (username, password) VALUES ('$username', '$password')") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been saved";
    $_SESSION["msg_type"] = "success";
    header("Location: users");
}

if (isset($_GET["delete"])){
    $id = $_GET["delete"];
    $mysqli->query("DELETE FROM tx_users WHERE ID_user = $id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been deleted";
    $_SESSION["msg_type"] = "danger";
    header("Location: users");
}

if (isset($_GET["edit"])){
    $id = $_GET["edit"];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tx_users WHERE ID_user=$id")  or die(mysqli_error($mysqli));
    if ($result){
        $row = $result->fetch_array();
        $name = $row["username"];
        $password = $row["password"];
    }
}

if (isset($_POST["update"])){
    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $mysqli->query("UPDATE tx_users SET username='$username', password='$password' WHERE ID_user=$id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been updated";
    $_SESSION["msg_type"] = "warning";
    header("Location: users");
}

