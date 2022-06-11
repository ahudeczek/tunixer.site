<?php

session_start();

$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));

$name = "";
$update = false;
$id = 0;

if (isset($_POST["save"])){
    $name = $_POST["name"];
    $mysqli->query("INSERT INTO tx_genres (name) VALUES ('$name')") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been saved";
    $_SESSION["msg_type"] = "success";
    header("Location: genres");
}

if (isset($_GET["delete"])){
    $id = $_GET["delete"];
    $mysqli->query("DELETE FROM tx_genres WHERE ID_g = $id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been deleted";
    $_SESSION["msg_type"] = "danger";
    header("Location: genres");
}

if (isset($_GET["edit"])){
    $id = $_GET["edit"];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tx_genres WHERE ID_g=$id")  or die(mysqli_error($mysqli));
    if ($result){
        $row = $result->fetch_array();
        $name = $row["name"];
    }
}

if (isset($_POST["update"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $mysqli->query("UPDATE tx_genres SET name='$name' WHERE ID_g=$id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been updated";
    $_SESSION["msg_type"] = "warning";
    header("Location: genres");
}

