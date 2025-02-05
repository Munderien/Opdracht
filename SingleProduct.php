<?php
// Door Marijn
// Dit is de single page (ik wist niet hoe je de naam moest veranderen)
include("Config.php");
include("Navbar.php");
//session_start();

if (isset($_GET["id"])) {

    $product_id = intval($_GET['id']);

    $getProduct = $db->prepare("SELECT * FROM product WHERE id = '$product_id'");
    $getProduct->execute();

    $x = $getProduct->fetch(PDO::FETCH_ASSOC);

    $product_id = $x['id'];
    $product_name = $x['naam'];
    $product_description = $x['beschrijving'];
    $product_price = $x['prijs'];
    $product_stock = $x['aantal'];
}

?>

<h3><b><?php echo htmlspecialchars($product_name); ?></b></h3>
<h3><b>€<?php echo htmlspecialchars($product_price); ?></b></h3>
<p><?php echo nl2br(htmlspecialchars($product_description)); ?></p>



<form action="GetProduct.php" method="GET">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_id); ?>">
        <label for="aantal">Aantal:</label>
        <input type="number" name="aantal" id="aantal" min="1" required>
        <button type="submit">Add To Cart</button>
    </form>