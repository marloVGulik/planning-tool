<?php 
    require("Data/PHP/DB/DBmanager.php");

    $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
    DBcommand($conn, "DELETE FROM planning WHERE `planning` . `id` = :id", [":id" => $_POST['id']]);

?>