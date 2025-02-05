
<?php
// Door Giovanni
include("Config.php");
include("Navbar.php");
session_start();

if ($_SESSION['rol'] != '1') {
    echo "Je hebt geen toegang om een product te bewerken";
    exit;
}

if ($_POST) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $naam = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);

    if (!$id || !$naam || !$password || !$mail) {
        echo "Invalid input. Please try again.";
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $v = $db->prepare("UPDATE user SET username = ?, password = ?, mail = ? WHERE id = ?");

    if ($v->execute(array($naam, $hashedPassword, $mail, $id))) {
        echo "Gebruiker is bijgewerkt";
        header("refresh:2; url=Admin.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het bijwerken";
    }
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        echo "Ongeldig ID";
        exit;
    }

    $v = $db->prepare("SELECT * FROM user WHERE id = ?");
    $v->execute(array($id));
    $product = $v->fetch();

    if (!$product) {
        echo "Gebruiker niet gevonden";
        exit;
    }
}
?>

<form method="post">
    username: <input type="text" name="username" value="<?php echo htmlspecialchars($product['username']); ?>"><br>
    password: <textarea name="password"></textarea><br>
    mail: <input type="text" name="mail" value="<?php echo htmlspecialchars($product['mail']); ?>"><br>
    <input type="submit" value="Bijwerken">
</form>