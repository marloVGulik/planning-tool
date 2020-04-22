<?php 

require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

// $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");

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
        $errorCode = DBcommand("INSERT INTO `planning` (`id`, `gameid`, `starttime`, `host`, `players`) VALUES (NULL, :gameid, :dt, :host, :players); ", [
            ":gameid" => $_POST['gameid'], 
            ":dt" => $sendDT, 
            ":host" => $_POST['host'],
            ":players" => $_POST['players']
        ])['errorCode'];
        if($errorCode != 00000) {
            echo "<div class='siz-10 container'><h2>Something went wrong creating a new item, error code: " . $errorCode . "</h2></div>";
        } else {
            echo "<div class='siz-10 container'><h2>Added a new item to planning successfully!</h2></div>";
        }
    } else {
        echo "Error: Not all items were set!";
    }
}

?>
<div class="container siz-10">
    <h2>Plan een nieuw spel</h2>
    <form action="plan.php" method="post" class="container siz-12">
        <label for="gameid">GAME: </label><select name="gameid" id="gameid">
            <?php 
            $result = DBcommand("SELECT * FROM games", [])['output'];
            foreach($result as $tmpResult) {
                ?><option value="<?= htmlspecialchars($tmpResult['id']) ?>"><?= htmlspecialchars($tmpResult['name']) ?></option><?php
            }
            ?>
        </select>
        <label for="startdate">START DATE:</label><input type="date" name="startdate" id="startdate">
        <label for="starttime">START TIME:</label><input type="time" name="starttime" id="starttime">
        <label for="host">HOST:</label><input type="text" name="host" id="host">
        <label for="players">PLAYERS:</label><input type="text" name="players" id="players">
        <input type="submit" value="PLAN DIT SPEL!" style="text-align: center; width: 100%">
    </form>
</div>