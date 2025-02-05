<?php
// Door Marijn
include('Config.php');
include("Navbar.php");
session_start();

if (isset($_POST['submit'])) {
    $userName = $_POST["userName"];
    $adres = $_POST["adres"];
    $email = $_POST["email"];

    $userId = $_SESSION['id'];

    $getUser = $db->prepare("SELECT * FROM user_data WHERE userId = :userId");
    $getUser->bindParam(':userId', $userId, PDO::PARAM_INT); // Securely bind the parameter
    $getUser->execute();

    $x = $getUser->fetch(PDO::FETCH_ASSOC);

    if ($x) {
        // update
        $v = $db->prepare("update user_data set
        userId=?, username=?, adres=?, email=?");
        $x = $v->execute(array($userId, $userName, $adres, $email));

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            @$total = 0;
            foreach ($cart as $key => $value) {
                $v = $db->prepare("SELECT * FROM product WHERE id = :id");
                $v->execute(['id' => $key]);

                $x = $v->fetch(PDO::FETCH_ASSOC);

                // The @ symbol is bc it gives a warning bc its not 100% guarenteed its an numberic, this is bc the database is set to a varchar
                @$combined += $x['prijs'] * $value['aantal'];

                echo $combined;
            }
        }



        if ($x) {
            $v = $db->prepare("insert into orders set 
            userId=?, totalprice=?");
            $x = $v->execute(array($userId, $combined));

            if ($x) {
                $orderId = $db->lastInsertId();

                foreach ($cart as $key => $value) {
                    $v = $db->prepare("SELECT * FROM product WHERE id = :id");
                    $v->execute(['id' => $key]);

                    $row_cart = $v->fetch(PDO::FETCH_ASSOC);

                    $v = $db->prepare("insert into orderproducten set 
            orderId=?, productId=?, quantity=?, price=?");
                    $x = $v->execute(array($orderId, $key, $value["aantal"], $row_cart["prijs"]));

                    if ($x) {
                        echo "Producten besteld!";
                        header("Refresh: 2; url=Index.php");
                    }
                }
            }
        }
    } else {
        // insert


        $v = $db->prepare("insert into user_data set
        userId=?, username=?, adres=?, email=?");
        $x = $v->execute(array($userId, $userName, $adres, $email));
        if ($x) {
            $v = $db->prepare("insert into user_data set
        userId=?, username=?, adres=?, email=?");
            $x = $v->execute(array($userId, $userName, $adres, $email));

            $v = $db->prepare("update user_data set
        userId=?, username=?, adres=?, email=?");
            $x = $v->execute(array($userId, $userName, $adres, $email));

            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                @$total = 0;
                foreach ($cart as $key => $value) {
                    $v = $db->prepare("SELECT * FROM product WHERE id = :id");
                    $v->execute(['id' => $key]);

                    $x = $v->fetch(PDO::FETCH_ASSOC);

                    // The @ symbol is bc it gives a warning bc its not 100% guarenteed its an numberic, this is bc the database is set to a varchar
                    @$combined += $x['prijs'] * $value['aantal'];
                }
            }



            if ($x) {
                $v = $db->prepare("insert into orders set 
            userId=?, totalprice=?");
                $x = $v->execute(array($userId, $combined));

                if ($x) {
                    $orderId = $db->lastInsertId();

                    foreach ($cart as $key => $value) {
                        $v = $db->prepare("SELECT * FROM product WHERE id = :id");
                        $v->execute(['id' => $key]);

                        $row_cart = $v->fetch(PDO::FETCH_ASSOC);

                        $v = $db->prepare("insert into orderproducten set 
            orderId=?, productId=?, quantity=?, price=?");
                        $x = $v->execute(array($orderId, $key, $value["aantal"], $row_cart["prijs"]));

                        if ($x) {
                            echo "producten besteld!";
                            header("Refresh: 2; url=Index.php");
                        }
                    }
                }
            }
        }
    }
}


?>
<form method="post">
    <p> Naam</p>
    <input type="text" name="userName" value="<?php if (isset($x['username'])) {
                                                    echo $x['username'];
                                                } ?>">
    <p> Adres</p>
    <input type="text" name="adres" value="<?php if (isset($x['adres'])) {
                                                echo $x['adres'];
                                            } ?>">
    <p> Email</p>
    <input type="text" name="email" value="<?php if (isset($x['email'])) {
                                                echo $x['email'];
                                            } ?>">
                                            <br>
    <input type="submit" value="Pay Now" name="submit">
</form>