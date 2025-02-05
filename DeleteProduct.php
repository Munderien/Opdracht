<?php
// Door Mert
include("Config.php");
include("Navbar.php");
session_start();

if ($_SESSION['rol'] != '1') {
    echo "je hebt geen toegang om een product te verwijderen";
    exit;
}

$id = $_GET['ProductId'];

$v = $db->prepare("DELETE FROM Artikel WHERE ProductId = ?");
$v->execute(array($id));

echo "product is verwijderd";
header("refresh:2; url=index.php");
exit;
?>