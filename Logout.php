<?php
session_start();

session_destroy();

echo "Tot de volgende keer...";

header("refresh:5;url=login.php");
?>