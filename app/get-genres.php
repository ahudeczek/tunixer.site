<?php
$db = mysqli_connect("sql102.epizy.com", "epiz_31786048", "EbTuI6yBml6gYN9", "epiz_31786048_project_wea_das"); 
mysqli_set_charset($db,"utf8");
$query = "SELECT * FROM tx_genres";
$result = mysqli_query($db, $query);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);