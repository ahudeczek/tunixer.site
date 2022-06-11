<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require ("favicon.phtml");
    require ("link_css.phtml");
    ?>
    <script src="stop-play.js"></script>
    <title>Funk</title>
</head>
<?php
require "auth_session.php";
$db = mysqli_connect("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das"); 
mysqli_set_charset($db,"utf8");
$get_all_rock_songs = "SELECT tx_songs.song_name, tx_songs.mp3, tx_songs.img, tg.name FROM tx_songs JOIN tx_groups tg on tg.ID_group = tx_songs.ID_group WHERE tx_songs.ID_g LIKE 9";
$result = mysqli_query($db, $get_all_rock_songs);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<body class="index-body">
<div class="dashboard-user">
    <p><a href="dash"><?php echo $_SESSION["username"] ?></a></p>
</div>
<div class="nav-index-genres">
    <div class="nav-index-genres-heading">
        <h2><a href="home" class="header-tunixer">Tunixer &copy;</a></h2>
    </div>
    <?php
    require ("nav_genres_index.phtml");
    ?>
</div>
<h1 class="songs-heading">Funk</h1>
<main>

    <?php
    foreach ( $songs as $song) {
        echo "<div class='song'>";
        $song["mp3"] = str_replace(' ', '', $song["mp3"]);
        $image = "songs/".$song["img"];
        $sound = "songs/".$song["mp3"];
        $group = $song["name"];
        echo "<img src=$image alt='song'>";
        echo "<h3>".$song["song_name"]."</h3>";
        echo "<p>".$song["name"]."</p>";
        echo "<audio id='audio' controls preload='none'>"."<source src=$sound type='audio/mpeg'>"."</audio>";
        echo "</div>";
    }
    ?>

</main>
<?php
require ("html_bottom.phtml");
?>

</body>
</html>