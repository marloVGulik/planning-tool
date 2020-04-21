<?php 
    require("Data/PHP/DB/DBmanager.php");

    // $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");

    if($_POST['confirmation'] == 'YES I WANT TO DELETE THIS') {
        DBcommand("DELETE FROM planning WHERE `planning` . `id` = :id", [":id" => $_POST['id']]);
    
        header("location: index.php");
    } else {
        header("location: index.php");
    }
?>