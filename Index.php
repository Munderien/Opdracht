<?php
// Door Marijn
include("Config.php");
include("Navbar.php");

$v = $db->prepare("select * from product");
$v->execute(array());
$x = $v->fetchAll(PDO::FETCH_ASSOC);

foreach ($x as $z) {
?>
    <div style="border: 1px solid black;
                background: blanchedalmond;
                height: 300px;
                width: 300px;
                margin: 5px;
                padding: 2px;
                float:left;
                text-align: center;
                font-size: 18;
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                ">
        test
        <h2 style="border: 1px solid black;
                   background: blue;
                    font-size: 18;
                    text-align: center;
                    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
            <?php echo $z['naam'] ?>
            <?php echo $z['beschrijving'] ?>
            <?php if (isset($z['id'])) ?>
<!-- Misschien nog een add to cart sectie naast de single page-->
                <a href="SingleProduct.php?id=<?php echo htmlspecialchars($z['id']); ?>">Product Details</a>


        </h2>
    </div>
<?php
}

?>