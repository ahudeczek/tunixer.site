<?php

session_start();

$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));

$name = "";
$est_date = "";
$ID_g = 0;
$update = false;
$id = 0;

if (isset($_POST["save"])){
    $name = $_POST["name"];
    $mysqli->query("INSERT INTO tx_groups (name, est_date, ID_g) VALUES ('$name', '$est_date', '$ID_g')") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been saved";
    $_SESSION["msg_type"] = "success";
    header("Location: groups");
}

if (isset($_GET["delete"])){
    $id = $_GET["delete"];
    $mysqli->query("DELETE FROM tx_groups WHERE ID_group = $id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been deleted";
    $_SESSION["msg_type"] = "danger";
    header("Location: groups");
}

if (isset($_GET["edit"])){
    $id = $_GET["edit"];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tx_groups WHERE ID_group=$id")  or die(mysqli_error($mysqli));
    if ($result){
        $row = $result->fetch_array();
        $name = $row["name"];
        $est_date = $row["est_date"];
        $ID_g = $row["ID_g"];
    }
}

if (isset($_POST["update"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $est_date = $_POST["est_date"];
    $ID_g = $_POST["ID_g"];
    $mysqli->query("UPDATE tx_groups SET name='$name', est_date='$est_date', ID_g='$ID_g' WHERE ID_group=$id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been updated";
    $_SESSION["msg_type"] = "warning";
    header("Location: groups");
}

