<?php
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

// $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
$result = DBcommand("SELECT * FROM planning", [])['output'];
// print_r($result);
?>
<div class="container siz-10">
    <h1 class="siz-12">PLANNING</h1>
    <a class="container siz-12 button" href="plan.php"><h2>Add to planning</h2></a>
    <table class="container siz-12" style="text-align: center">
        <tr>
            <th>Logo</th>
            <th>Name game</th>
            <th>Starting time</th>
            <th>Total time</th>
            <th>Host</th>
            <th>Players</th>
            <th>Actions</th>
        </tr>
        <?php
            foreach($result as $tmpRes) { // Opnieuw doen, we hebben soorten spellen gekregen, niet een planning!
                $date = new DateTime($tmpRes['starttime']);
                $gameres = DBcommand("SELECT * FROM games WHERE id = :id", [":id" => $tmpRes['gameid']])['output'];
                ?>
                <tr>
                    <td class="no-padding"><img class="logo" src="<?= "Data/images/" . htmlspecialchars($gameres[0]['image']) ?>" alt="game logo"></td>
                    <td><?= htmlspecialchars($gameres[0]['name']) ?></td>
                    <td><?= htmlspecialchars($date->format('m-d-Y')) . "<br>" . htmlspecialchars($date->format('H:i A')) ?></td>
                    <td><?= "Explain time: " . htmlspecialchars($gameres[0]['explain_minutes']) . "<br>Playing time: " . htmlspecialchars($gameres[0]['play_minutes']) ?></td>
                    <td><?= htmlspecialchars($tmpRes['host']) ?></td>
                    <td><?= htmlspecialchars($tmpRes['players']) ?></td>
                    <td>
                        <form action="details.php" method="get" style="width: 100%">
                            <input type="hidden" value="<?= $tmpRes['id'] ?>" name="id"></input>
                            <input type="submit" value="Details" style="width: 100%">
                        </form>
                        <form action="edit.php" method="post" style="width: 100%">
                            <input type="hidden" value="<?= $tmpRes['id'] ?>" name="id"></input>
                            <input type="submit" value="Change" style="width: 100%">
                        </form>
                        <form action="delete-action.php" method="post" style="width: 100%">
                            <input type="hidden" value="<?= $tmpRes['id'] ?>" name="id"></input>
                            <input type="submit" value="Delete" style="width: 100%">
                        </form>
                    </td>
                </tr>
                <?php
            }
        ?>
    </table>
</div>