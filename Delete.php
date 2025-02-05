<?php
// Door Mert
include("Config.php");
$id = $_GET['id'];

$delete = $db->prepare("delete from product where id=?");
$x = $delete->execute(array($id));

if($x) {
    echo "Je hebt een artikel Verwijderd!";
    header("refresh:2;url=Index.php");
}
?>
