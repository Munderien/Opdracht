<?php
include("Config.php");
session_start();

       echo "welkom " . $_SESSION['user'] . " <a href='Logout.php'>uitloggen </a>
       <a href='Change.php?id=" . $_SESSION['id'] . "'>Profiel Wijzigen </a>";
   
           if ($_SESSION['rol'] == 1) {
               echo "<a href='admin.php'>Admin Panel </a>";
           }
       
?>