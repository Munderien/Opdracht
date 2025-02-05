<?php
// Door Marijn
include("Config.php");
include("Navbar.php");
session_start();

if ($_SESSION) {
    if ($_SESSION['rol'] == 1) {
        echo "Welkom op de admin pagina " . $_SESSION['user'] . "<br><a href='ViewAccountAdmin.php' class='register-button'>Accounts aanpassen</a>";
        echo "<a href='SelectProduct.php' class='register-button'>Product beheer</a>";
        echo "<a href='CreateProduct.php' class='register-button'>Product maken</a>";
    } else {
        echo "Er is een probleem opgetreden";
    }
} else {
    echo "Je moet inloggen als admin";
}
?>
