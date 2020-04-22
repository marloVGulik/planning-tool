<?php
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

// $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
$result = DBcommand("SELECT * FROM games", [])['output'];
// print_r($result);
?>
<div class="container siz-10">
    <?php foreach($result as $tmpResult) { ?>
        <form class="container siz-4" method="get" action="gameDetail.php">
            <input type="hidden" name="gameid" value="<?= $tmpResult['id'] ?>">
            <img src="Data/images/<?= $tmpResult['image'] ?>" alt="<?= $tmpResult['image'] ?>" style="height: 15rem" class="siz-12" >
            <h2><?= $tmpResult['name'] ?></h2>
            <input type="submit" value="View game" style="width: 100%">
        </form>
    <?php } ?>
</div>