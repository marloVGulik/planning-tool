<?php
// $DBuser = "";
// $DBpass = "";
// $DBname = "";

function createConn($DBuser, $DBpass, $DBname) {
    $conn = NULL;
    try {
        $conn = new PDO('mysql:host=localhost;dbname=' . $DBname, $DBuser, $DBpass);
    } catch(PDOexception $exception) {
        echo $exception;
        return NULL;
    }
    return $conn;
}

// function DBcommand($connection, $statement, $args) {
function DBcommand($statement, $args) {
    $connection = createConn("gamemanager", "yQYlpIQ9tyEVZeFV", "spellen");
    $execStatement = $connection->prepare($statement);
    $execStatement->execute($args);
    $connection = null;
    return $execStatement->fetchAll();
}

?>