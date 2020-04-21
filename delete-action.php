<?php 

require("Data/HTML/head.html");

?>

<form class="container siz-10" method="post" action="delete.php">
    <input value="<?= $_POST['id'] ?>" name="id" hidden>
    <label for="confirmation" style="width: 100%">Type "YES I WANT TO DELETE THIS" to delete this game. Any other values will be rejected!</label><input type="text" style="width: 100%" id="confirmation" name="confirmation">
    <input type="submit" value="Continue" style="width: 100%">
</form>