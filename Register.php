<?php
// Door Giovanni
include("Config.php");

$v = $db->prepare("insert into user set username=?, password=?, mail=?");

@$unaam = htmlentities($_POST['unaam'], ENT_QUOTES);
@$ww = md5(addslashes($_POST['ww']));
@$email = htmlspecialchars($_POST['email'], ENT_QUOTES);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$unaam || !$ww || !$email) {
        $message = "De velden zijn leeg";
    } else {
        $x = $v->execute(array($unaam, $ww, $email));

        if ($x) {
            echo "Registratie is gelukt, U wordt doorverwezen...";
            header("refresh:2; url=index.php");
            exit;
        }
    }
}
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

        .message {
            color: #fff;
            font-size: 18px;
            margin-bottom: 10px;
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="submit"] {
            border-radius: 5px;
            border: 2px solid black;
            margin: 5px;
            padding: 5px 10px;
            background: #1a5bbd;
            color: black;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #134a9e;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 8px;
        }

        .form-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="unaam"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="ww"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="versturen" value="registreren">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>