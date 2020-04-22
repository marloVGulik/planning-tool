<?php 
    require("Data/PHP/DB/DBmanager.php");
    require("Data/HTML/head.html");

    // $conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
?>

<div class="container siz-10">
    <h2><?php
    
    if($_POST['confirmation'] == 'YES I WANT TO DELETE THIS') {
        $errorCode = DBcommand("DELETE FROM planning WHERE `planning` . `id` = :id", [":id" => $_POST['id']])['errorCode'];
        if($errorCode == 00000) {
            echo "DELETE SUCCESS!";
        } else {
            echo "DELETE FAILED: errorcode " . $errorCode;
        }
    } else {
        echo "NOT DELETED, WRONG MESSAGE!";
    }
    
    ?></h2>
</div>