<?php
try{
$db = new PDO("mysql:host=localhost;dbname=3sv1;", "root", "");
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
?>