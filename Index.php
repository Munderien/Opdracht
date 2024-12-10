<?php
include("Config.php");

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
                    <a onclick="return confirm('Are u sure you want to delete this product?')"
                    href="Delete.php?id=<?php echo $z['id']; ?>"> Delete </a>
                    
                    </h2>
                    
    </div>
    <a onclick="return" href="UserData.php">Hallo</a>
<?php
}

?>