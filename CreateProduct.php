<?php
// Door Mert
include("Config.php");
include("Navbar.php");
session_start();

if ($_SESSION['rol'] != '1') {
    echo "Je hebt geen toegang om een product toe te voegen.";
    exit;
}

$v = $db->prepare("INSERT INTO Artikel SET productNaam=?, productBeschrijving=?, productPrijs=?, productAantal=?");

$naam = $_POST['naam'];
$beschrijving = $_POST['beschrijving'];
$prijs = $_POST['prijs'];
$aantal = $_POST['aantal'];

if (!$naam || !$beschrijving || !$prijs || !$aantal) {
    echo "de velden zijn leeg";
} else {
    $x = $v->execute(array($naam, $beschrijving, $prijs, $aantal));

    if ($x) {
        echo "product is toegevoegd";
        header("refresh:2; url=index.php");
    }
}
?>

<form method="post">
    <table>
        <tr>
            <td>Naam:</td>
            <td><input type="text" name="naam"></td>
        </tr>
        <tr>
            <td>Beschrijving:</td>
            <td><textarea name="beschrijving"></textarea></td>
        </tr>
        <tr>
            <td>Prijs:</td>
            <td><input type="text" name="prijs"></td>
        </tr>
        <tr>
            <td>Aantal:</td>
            <td><input type="text" name="aantal"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Opslaan"></td>
        </tr>
    </table>
</form>