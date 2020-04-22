<?php 
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

$planningResult = DBcommand("SELECT * FROM planning WHERE id = :id", [':id' => $_GET['id']])['output'];

if(!isset($planningResult[0]['host'])) {
    header("location: index.php");
}

$gameResult = DBcommand("SELECT * FROM games WHERE id = :id", [':id' => $planningResult[0]['gameid']])['output'];



$date = new DateTime($planningResult[0]['starttime']);

?>
<a href="index.php" class="container siz-10"><h1>HOME</h1></a>
<div class="container siz-10">
    <img src="Data/images/<?= htmlspecialchars($gameResult[0]['image']) ?>" alt="logo" class="logoLarge">
    <h1>Game: <?= htmlspecialchars($gameResult[0]['name']) ?></h1>
    <p><?= $gameResult[0]['description'] ?></p>

    <h2>Game data:</h2>
    <p>Expansions: <?= htmlspecialchars($gameResult[0]['expansions']) ?></p>
    <p>Skills: <?= htmlspecialchars($gameResult[0]['skills']) ?></p>
    <p>Minimal amount of players: <?= htmlspecialchars($gameResult[0]['min_players']) ?><br> Maximum amount of players: <?= htmlspecialchars($gameResult[0]['max_players']) ?></p>
    <p>Explaination time: <?= htmlspecialchars($gameResult[0]['explain_minutes']) ?><br> Play time: <?= htmlspecialchars($gameResult[0]['play_minutes']) ?></p>

    <div class="siz-12 container">
        <p>Explaination in text: <a href="<?= htmlspecialchars($gameResult[0]['url']) ?>">LINK</a></p>
        <p>Video:</p>
        <?= $gameResult[0]['youtube'] ?>
    </div>
</div>
<div class="container siz-10">
    <h1>Planning details:</h1>
    <p>Host: <?= htmlspecialchars($planningResult[0]['host']) ?></p>
    <p>Players: <?= htmlspecialchars($planningResult[0]['players']) ?></p>
    <p>Starting date and time: <?= htmlspecialchars($date->format('m-d-Y H:i A')) ?></p>
</div>