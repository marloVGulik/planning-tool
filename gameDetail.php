<?php
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

// $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
$result = DBcommand("SELECT * FROM games WHERE id = :id", [':id' => $_GET['gameid']])['output'];
if(!isset($result[0]['name'])) {
    header("location: games.php");
}
// print_r($result);
?>


<div class="container siz-10">
    <img src="Data/images/<?= htmlspecialchars($result[0]['image']) ?>" alt="logo" class="logoLarge">
    <h1>Game: <?= htmlspecialchars($result[0]['name']) ?></h1>
    <p><?= $result[0]['description'] ?></p>

    <h2>Game data:</h2>
    <p>Expansions: <?= htmlspecialchars($result[0]['expansions']) ?></p>
    <p>Skills: <?= htmlspecialchars($result[0]['skills']) ?></p>
    <p>Minimal amount of players: <?= htmlspecialchars($result[0]['min_players']) ?><br> Maximum amount of players: <?= htmlspecialchars($result[0]['max_players']) ?></p>
    <p>Explaination time: <?= htmlspecialchars($result[0]['explain_minutes']) ?><br> Play time: <?= htmlspecialchars($result[0]['play_minutes']) ?></p>

    <div class="siz-12 container">
        <p>Explaination in text: <a href="<?= htmlspecialchars($result[0]['url']) ?>">LINK</a></p>
        <p>Video:</p>
        <?= $result[0]['youtube'] ?>
    </div>
</div>