<?php
// Door Marijn
include("Config.php");
include("Navbar.php");
session_start();

// Initialize cart to avoid warnings if it's not set
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>

<?php if (!empty($cart)): ?>
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        @$total = 0;
        foreach ($cart as $key => $value) {
            $v = $db->prepare("SELECT * FROM product WHERE id = :id");
            $v->execute(['id' => $key]);

            $x = $v->fetch(PDO::FETCH_ASSOC);

            // The @ symbol is bc it gives a warning bc its not 100% guarenteed its an numberic, this is bc the database is set to a varchar
            @$combined += $x['prijs'] * $value['aantal'];
            if ($x) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($x['naam']); ?></td>
                    <td>€<?php echo htmlspecialchars($x['prijs']); ?></td>
                    <td><?php echo htmlspecialchars($value['aantal']); ?></td>
                    <td><?php echo $combined?></td>
                    <td>
                        <a href="DeleteCart.php?id=<?php echo $key; ?>">Remove</a>
                    </td>
                </tr>
                <?php
            } else {
                echo "<tr><td colspan='4'>Product not found for ID: " . htmlspecialchars($key) . "</td></tr>";
            }
            @$total = @$total + @$combined;
        }
        ?>
    </table>

    <table>
        <tr>
            <td> Total price: €<?php echo $total; ?> </td>
            <td> <a href="Checkout.php">Check out!</a>
        </tr>
    </table>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>
