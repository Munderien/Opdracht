<?php
include("Config.php");
session_start();

$id = $_GET['id'];

$v = $db->prepare("select * from user where id=?");
$v->execute(array($id));

$x = $v->fetch(PDO::FETCH_ASSOC);

$z = $db->prepare("update user set username=?,
                      password=? where id=?");
if ($_POST) {
    $naam = htmlspecialchars($_POST['naam'], ENT_QUOTES);
    $wachtwoord = md5(addslashes($_POST['wachtwoord']));

    $zz = $z->execute(array($naam, $wachtwoord, $id));

    if ($zz) {
        echo "Wijzigingen zijn doorgevoerd, je wordt doorverwezen!";
        header("refresh:5;url:Index.php");
    } else {
        echo "Er is iets fout gegaan :(";
    }
} else {
    if($_SESSION['id'] == $id) {
        echo '
<form method="post" action="">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="naam" value="'.$x['username'].'"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="wachtwoord" value="'.$x['password'].'"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Wijzig gegevens"></td>
        </tr>
    </table>
</form>';
    }
    else {
        echo "pagina niet gevonden";
    }
}
