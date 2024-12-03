<?php
// verbinding met het php bestand
include("Config.php");

$v = $db->prepare("insert into user set
username=?, password=?, mail=?");

$unaam = htmlentities($_POST['unaam'], ENT_QUOTES);
$ww = md5(addslashes($_POST['ww']));
$email =htmlspecialchars( $_POST['email'], ENT_QUOTES);
if(!$unaam || !$ww || !$email) {
echo "De velden zijn leeg";
}
else {

$x = $v->execute(array($unaam,$ww,$email));

if($x)
{
    echo "Registratie is gelukt, U wordt doorverwezen...";
    header("refresh:5; url=index.php");
}
}
?>
<form method="post" action="">
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="unaam"> </td>
        </tr>

        <tr>
            <td>Password: </td>
            <td><input type="password" name="ww"> </td>
        </tr>

        <tr>
            <td>Email: </td>
            <td><input type="text" name="email"> </td>
        </tr>

        <tr>
            <td> <input type="submit" name="versturen" value="registreren"> </td>
        </tr>
    </table>
</form>