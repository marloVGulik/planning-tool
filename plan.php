<?php 

require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

$conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dt = new DateTime($_POST['startdate'] . "T" . $_POST['starttime']);
    $sendDT = $dt->format('Y-m-d\TH:i:s.u');;
    DBcommand($conn, "INSERT INTO `planning` (`id`, `gameid`, `starttime`, `host`, `players`) VALUES (NULL, :gameid, :dt, :host, :players); ", [
        ":gameid" => $_POST['gameid'], 
        ":dt" => $sendDT, 
        ":host" => $_POST['host'],
        ":players" => $_POST['players']
    ]);
}

?>
<a class="container siz-10" href="index.php"><h1>HOME</h1></a>
<div class="container siz-10">
    <h2>Plan een nieuw spel</h2>
    <form action="plan.php" method="post" class="container siz-12">
        <label for="gameid">GAME: </label><select name="gameid" id="gameid">
            <?php 
            $result = DBcommand($conn, "SELECT * FROM games", []);
            foreach($result as $tmpResult) {
                ?><option value="<?= $tmpResult['id'] ?>"><?= $tmpResult['name'] ?></option><?php
            }
            ?>
        </select>
        <label for="startdate">START DATE:</label><input type="date" name="startdate" id="startdate">
        <label for="starttime">START TIME:</label><input type="time" name="starttime" id="starttime">
        <label for="host">HOST:</label><input type="text" name="host" id="host">
        <label for="Players">PLAYERS:</label><input type="text" name="players" id="players">
        <input type="submit" value="PLAN DIT SPEL!" style="text-align: center; width: 100%">
    </form>
</div>