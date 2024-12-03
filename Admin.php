<?php
include("Config.php");
session_start();

if ($_SESSION) {
    if ($_SESSION['rol'] == 1) {
        echo "Welkom op de admin pagina" . $_SESSION['user'];
    } else {
        echo "Er is een probleem opgetreden";
    }
} else {
    echo "Je moet inloggen als admin";
}
