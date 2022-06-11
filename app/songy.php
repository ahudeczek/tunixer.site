<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    require "favicon.phtml";
    ?>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <title>Crud - Songs</title>
</head>
<body>
<?php require_once "process-songs.php"?>
<?php
$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));
    //group, lang, genre, singer
    $sql_groups = "SELECT * FROM tx_groups";
    $sql_genres = "SELECT * FROM tx_genres";
    $sql_langs = "SELECT * FROM tx_languages";
    $result_groups = $mysqli->query($sql_groups);
    $result_genres = $mysqli->query($sql_genres);
    $result_langs = $mysqli->query($sql_langs);
    $groups = $result_groups->fetch_array();
    $genres = $result_genres->fetch_array();
    $langs = $result_langs->fetch_array();
?>

<?php
if (isset($_SESSION["message"])){?>
    <div class="alert alert-<?=$_SESSION["msg_type"]?>">
        <?php
        echo $_SESSION["message"];
        unset($_SESSION["message"]);
        ?>
    </div>
<?php } ?>
<div class="container">
    <?php
    $result = $mysqli->query("SELECT * FROM tx_songs");
    //pre_r($result);
    //pre_r($result->fetch_assoc());
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th>Song Name</th>
                <th>Length</th>
                <th>MP3</th>
                <th>Image</th>
                <th>Genre</th>
                <th>Language</th>
                <th>Group</th>
                <th>Singer</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()){?>
                <tr>
                    <td><?php echo $row["song_name"]?></td>
                    <td><?php echo $row["length"]?></td>
                    <td><?php echo $row["mp3"]?></td>
                    <td><?php echo $row["img"]?></td>
                    <td><?php echo $row["ID_g"]?></td>
                    <td><?php echo $row["ID_l"]?></td>
                    <td><?php echo $row["ID_group"]?></td>
                    <td><?php echo $row["ID_sin"]?></td>
                    <td>
                        <a href="songs?edit=<?php echo $row["ID_s"]; ?>" class="btn btn-info">Edit</a>
                        <a href="process-songs.php?delete=<?php echo $row["ID_s"]; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>


    <?php
    function pre_r($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    ?>
    <div class="row justify-content-center">
        <form action="process-songs.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="song_name">Song Name</label>
                <input type="text" id="song_name" name="song_name" class="form-control" value="<?php echo $song_name; ?>" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="length">Length</label>
                <input type="text" id="length" name="length" class="form-control" value="<?php echo $length; ?>" placeholder="Enter Length">
            </div>
            <div class="form-group">
                <label for="mp3">MP3</label>
                <input type="text" id="mp3" name="mp3" class="form-control" value="<?php echo $mp3; ?>" placeholder="Enter MP3 (name)">
            </div>
            <div class="form-group">
                <label for="img">Image</label>
                <input type="text" id="img" name="img" class="form-control" value="<?php echo $img; ?>" placeholder="Enter Image (name)">
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" class="form-control">
                    <?php
                    while ($genre = $result_genres->fetch_array()) {
                        $genre_id = $genre["ID_g"];
                        echo "<option value=$genre_id>" . $genre["name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lang">Language</label>
                <select name="lang" id="lang" class="form-control">
                    <?php
                    while ($lang = $result_langs->fetch_array()) {
                        $lang_id = $lang["ID_l"];
                        echo "<option value=$lang_id>" . $lang["name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="group">Group</label>
                <select name="group" id="group" class="form-control">
                    <option value=NULL>Empty</option>
                    <?php
                    while ($group = $result_groups->fetch_array()) {
                        $group_id = $group["ID_group"];
                        echo "<option value=$group_id>" . $group["name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <?php
                if ($update == true){ ?>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                <?php }else{ ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php } ?>
            </div>
        </form>
    </div>
</div>
</body>
</html>