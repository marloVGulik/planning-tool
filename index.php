<?php
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

$conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
$result = DBcommand($conn, "SELECT * FROM planning", []);

// print_r($result);
?>
<div class="container siz-10">
    <h1 class="siz-12">PLANNING</h1>
    <a class="container siz-12" href="plan.php"><h2>Voeg iets toe aan de planning</h2></a>
    <table class="container siz-12" style="text-align: center">
        <tr>
            <th>Logo</th>
            <th>Naam spel</th>
            <th>Starttijd</th>
            <th>Totale tijd</th>
            <th>Host</th>
            <th>Spelers</th>
        </tr>
        <?php
            foreach($result as $tmpRes) { // Opnieuw doen, we hebben soorten spellen gekregen, niet een planning!
                $gameres = DBcommand($conn, "SELECT * FROM games WHERE id = :id", [":id" => $tmpRes['gameid']]);
                ?>
                <tr>
                    <td class="no-padding"><img class="logo" src="<?= "Data/images/" . $gameres[0]['image'] ?>"></td>
                    <td><?= $gameres[0]['name'] ?></td>
                    <td><?= $tmpRes['starttime'] ?></td>
                    <td><?= $gameres[0]['explain_minutes'] . " minuten voor uitleg en " . $gameres[0]['play_minutes'] . " minuten speeltijd" ?></td>
                    <td><?= $tmpRes['host'] ?></td>
                    <td><?= $tmpRes['players'] ?></td>
                </tr>
                <?php
            }
        ?>
    </table>
</div>