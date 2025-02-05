<?php
// Door Mert
include("Config.php");
include("Navbar.php");
session_start();

if ($_SESSION['rol'] != '1') {
    echo "je hebt geen toegang om een product te bewerke";
    exit;
}

if ($_POST) {
    $id = $_GET['ProductId'];
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $aantal = $_POST['aantal'];

    $v = $db->prepare("UPDATE Artikel SET productNaam = ?, productBeschrijving = ?, productPrijs = ?, productAantal = ? WHERE ProductId = ?");
    $v->execute(array($naam, $beschrijving, $prijs, $aantal, $id));

    echo "product is bijgewerkt";
    header("refresh:2; url=index.php");  
    exit;
} else {
    $id = $_GET['ProductId'];
    $v = $db->prepare("SELECT * FROM Artikel WHERE ProductId = ?");
    $v->execute(array($id));
    $product = $v->fetch();
}
?>
<form method="post">
    Naam: <input type="text" name="naam" value="<?php echo $product['productNaam']; ?>"><br>
    Beschrijving: <textarea name="beschrijving"><?php echo $product['productBeschrijving']; ?></textarea><br>
    Prijs: <input type="text" name="prijs" value="<?php echo $product['productPrijs']; ?>"><br>
    Aantal: <input type="text" name="aantal" value="<?php echo $product['productAantal']; ?>"><br>
    <input type="submit" value="Bijwerken">
</form>