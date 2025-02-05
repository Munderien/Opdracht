<?php
// Door Mert
include("Config.php");
include("Navbar.php");
session_start();

$v = $db->query("SELECT * FROM Artikel");
while ($row = $v->fetch()) {
    echo "ID: " . $row['ProductId'] . "<br>";
    echo "Naam: " . $row['productNaam'] . "<br>";
    echo "Beschrijving: " . $row['productBeschrijving'] . "<br>";
    echo "Prijs: " . $row['productPrijs'] . "<br>";
    echo "Aantal: " . $row['productAantal'] . "<br>";

    if ($_SESSION['rol'] == '1') {
        echo "<a href='update.php?ProductId=" . $row['ProductId'] . "'>Bewerken</a> | ";
        echo "<a href='delete.php?ProductId=" . $row['ProductId'] . "'>Verwijderen</a><br>";
    }
}
?>