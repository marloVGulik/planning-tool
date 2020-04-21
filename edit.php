<?php 

require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

$conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");

$nameArray = [
    'gameid',
    'startdate',
    'starttime',
    'host',
    'players'
];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkBool = true;
    foreach($nameArray as $key) {
        if(!isset($_POST[$key])) {
            $checkBool = false;
        } else if(strlen(strval($_POST[$key])) < 1) {
            $checkBool = false;
        }
    }
    if($checkBool) {
        $dt = new DateTime($_POST['startdate'] . "T" . $_POST['starttime']);
        $sendDT = $dt->format('Y-m-d\TH:i:s.u');
        DBcommand($conn, "UPDATE `planning` SET `gameid` = :gameid, `starttime` = :dt, `host` = :host, `players` = :players WHERE `planning` . `id` = :id", [
            ":gameid" => $_POST['gameid'], 
            ":dt" => $sendDT, 
            ":host" => $_POST['host'],
            ":players" => $_POST['players'],
            ":id" => $_POST['id']
        ]);
    } else {
        // echo "Error: Not all items were set!";
    }
}

$planningResult = DBcommand($conn, "SELECT * FROM `planning` WHERE `id` = :id", [':id' => $_POST['id']]);
$date = new DateTime($planningResult[0]['starttime']);

?>
<a class="container siz-10" href="index.php"><h1>HOME</h1></a>
<div class="container siz-10">
    <h2>Plan een nieuw spel</h2>
    <form action="edit.php" method="post" class="container siz-12">
        <label for="gameid">GAME: </label><select name="gameid" id="gameid">
            <?php 
            $result = DBcommand($conn, "SELECT * FROM games", []);
            foreach($result as $tmpResult) {
                ?><option value="<?= $tmpResult['id'] ?>" <?php if($tmpResult['id'] == $planningResult[0]['gameid']) echo "selected"; ?>><?= $tmpResult['name'] ?></option><?php
            }
            ?>
        </select>
        <label for="startdate">START DATE:</label><input type="date" name="startdate" id="startdate" value="<?= $date->format("Y-m-d");?>">
        <label for="starttime">START TIME:</label><input type="time" name="starttime" id="starttime" value="<?= $date->format("H:i");?>">
        <label for="host">HOST:</label><input type="text" name="host" id="host" value="<?= $planningResult[0]['host'] ?>">
        <label for="Players">PLAYERS:</label><input type="text" name="players" id="players" value="<?= $planningResult[0]['players'] ?>">
        <input name="id" value="<?= $_POST['id'] ?>" hidden>
        <input type="submit" value="VERANDER PLANNING!" style="text-align: center; width: 100%">
    </form>
</div>