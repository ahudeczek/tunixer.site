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
    <title>Crud - Groups</title>
</head>
<body>
<?php require_once "process-groups.php"?>

<?php
$mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));
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
    $sql_genres = "SELECT * FROM tx_genres";
    $result_genres = $mysqli->query($sql_genres);
    $genres = $result_genres->fetch_array();
    $result = $mysqli->query("SELECT * FROM tx_groups");
    //pre_r($result);
    //pre_r($result->fetch_assoc());
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Date of Establishment</th>
                <th>Genre</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()){?>
                <tr>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["est_date"]?></td>
                    <td><?php echo $row["ID_g"]?></td>
                    <td>
                        <a href="groups?edit=<?php echo $row["ID_group"]; ?>" class="btn btn-info">Edit</a>
                        <a href="process-groups.php?delete=<?php echo $row["ID_group"]; ?>" class="btn btn-danger">Delete</a>
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
        <form action="process-groups.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="est_date">Date of Establishment (phpMyAdmin format)</label>
                <input type="text" id="est_date" name="est_date" class="form-control" value="<?php echo $est_date; ?>" placeholder="Enter Date Of Establishment">
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" class="form-control">
                    <?php
                    while ($genre = $result_genres->fetch_array(MYSQLI_ASSOC)) {
                        $genre_id = $genre["ID_g"];
                        echo "<option value=$genre_id>" . $genre["name"] . "</option>";
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