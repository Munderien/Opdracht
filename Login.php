<?php
// Door Giovanni
include("Config.php");
session_start();
if ($_POST) {

    $v = $db->prepare("select * from user where username = ? and password = ?");

    $naam = $_POST['naam'];
    $wachtwoord = md5(addslashes($_POST['wachtwoord']));

    $v->execute(array($naam, $wachtwoord));

    $x = $v->fetch(PDO::FETCH_ASSOC);

    $d = $v->rowCount();

    if ($d) {
        $_SESSION['user'] = $x['username'];
        $_SESSION['id'] = $x['id'];
        $_SESSION['rol'] = $x['rol'];

    if ($_SESSION) {
        echo "Registratie is gelukt, U wordt doorverwezen...";
        header("refresh:2; url=index.php");
        exit;
    }
    exit;
        
    } else {
        echo "U heeft de verkeerde gegevens ingevoerd";
    }

} else {
?>
    <html>

    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #6a11cb, #2575fc);
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #fff;
            }

            input[type="submit"], a.register-button {
                border-radius: 5px;
                border: 2px solid black;
                margin: 5px;
                padding: 5px 10px;
                background: #1a5bbd;
                color: black;
                font-size: 16px;
                text-align: center;
                display: inline-block;
                text-decoration: none;
                cursor: pointer;
            }

            input[type="submit"]:hover, a.register-button:hover {
                background: #134a9e;
            }
        </style>
    </head>

    <body>
        <form method="post" action="">
            <table>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="naam"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="wachtwoord"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="inloggen"></td>
                    <td><a href="register.php" class="register-button">Register</a></td>
                </tr>
            </table>
        </form>
    </body>

    </html>
<?php
}
?>