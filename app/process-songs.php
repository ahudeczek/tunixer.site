<?php
session_start();

$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));

$song_name = "";
$length = 0;
$mp3 = "";
$img = "";
$ID_g = 0;
$ID_l = 0;
$ID_group = 0;
$update = false;
$id = 0;

if (isset($_POST["save"])) {
    $song_name = $_POST["song_name"];
    $length = $_POST["length"];
    $mp3 = $_POST["mp3"];
    $img = $_POST["img"];
    $ID_g = $_POST["genre"];
    $ID_l = $_POST["lang"];
    $ID_group = $_POST["group"];
    $ID_sin = $_POST["singer"];
    $mysqli->query("INSERT INTO tx_songs (song_name, length, mp3, img, id_g, id_l, id_group) VALUES ('$song_name', '$length', '$mp3', '$img', '$ID_g', '$ID_l', '$ID_group')") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been saved";
    $_SESSION["msg_type"] = "success";
    header("Location: songs");
}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $mysqli->query("DELETE FROM tx_songs WHERE ID_s = $id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been deleted";
    $_SESSION["msg_type"] = "danger";
    header("Location: songs");
}

if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tx_songs WHERE ID_s=$id") or die(mysqli_error($mysqli));
    if ($result) {
        $row = $result->fetch_array();
        $song_name = $row["song_name"];
        $length = $row["length"];
        $mp3 = $row["mp3"];
        $img = $row["img"];
        $ID_g = $row["ID_g"];
        $ID_l = $row["ID_l"];
        $ID_group = $row["ID_group"];
    }
}

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $song_name = $_POST["song_name"];
    $length = $_POST["length"];
    $mp3 = $_POST["mp3"];
    $img = $_POST["img"];
    $ID_g = $_POST["ID_g"];
    $ID_l = $_POST["ID_l"];
    $ID_group = $_POST["ID_group"];
    $ID_sin = $_POST["ID_sin"];
    $mysqli->query("UPDATE tx_songs SET song_name='$song_name', length='$length', mp3='$mp3', img='$img', ID_g='$ID_g', ID_l='$ID_l', ID_group='$ID_group' WHERE ID_s=$id") or die(mysqli_error($mysqli));
    $_SESSION["message"] = "Record has been updated";
    $_SESSION["msg_type"] = "warning";
    header("Location: songs");
}

