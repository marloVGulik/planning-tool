<?php
require("Data/HTML/head.html");
require("Data/PHP/DB/DBmanager.php");

$conn = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
$result = DBcommand($conn, "SELECT * FROM games", []);

print_r($result);
?>