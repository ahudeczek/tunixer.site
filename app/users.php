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
    <title>Crud - Users</title>
</head>
<body>
<?php require_once "process-users.php"?>

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
    $mysqli = new mysqli("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das") or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM tx_users");
    //pre_r($result);
    //pre_r($result->fetch_assoc());
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()){?>
                <tr>
                    <td><?php echo $row["username"]?></td>
                    <td><?php echo $row["password"]?></td>
                    <td>
                        <a href="users?edit=<?php echo $row["ID_user"]; ?>"  class="btn btn-info">Edit</a>
                        <a href="process-users.php?delete=<?php echo $row["ID_user"]; ?>" class="btn btn-danger">Delete</a>
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
        <form action="process-users.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter Password" autocomplete="off">
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