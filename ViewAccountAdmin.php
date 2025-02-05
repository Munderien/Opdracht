<?php
// Door Giovanni
include("Config.php");
include("Navbar.php");
session_start();

$v = $db->query("SELECT * FROM user");
while ($row = $v->fetch()) {
    echo "Username: " . $row['username'] . "<br>";
    echo "Password: " . $row['password'] . "<br>";
    echo "Mail: " . $row['mail'] . "<br>";

    if ($_SESSION['rol'] == '1') {
        echo "<a href='ChangeAccountAdmin.php?id=" . $row['id'] . "'>Bewerken</a> | ";
        // Gio je bent de Verwijder account vergeten voor de 300ste keer
    }
}
?>