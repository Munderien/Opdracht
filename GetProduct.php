<?php
// Door Marijn
// Bestelling van producten
include("Config.php");

session_start();

if (isset($_GET['id'])) {
    if (isset($_GET['aantal'])) {
        $Quantity = $_GET['aantal'];
    } else {
        $Quantity = 1;
    }
    $id = $_GET['id']; // Corrected $_get to $_GET

    $_SESSION['cart'][$id] = array('aantal' => $Quantity);
    header('location: Index.php');
    

} 
?>
