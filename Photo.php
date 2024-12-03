<?php
$maxgroot = 500000;
$geefnaam = substr($_FILES['Image']['name'],-5,5);

$mapnaam = rand(0,99999).$geefnaam;

$mappath = "Image/".$mapnaam;

if($_FILES["Image"]["size"]>$maxgroot)
{
    echo "Uw bestand is te groot";
}
else 
{
    $d = $_FILES["Image"]["type"];
    if ($d == "image/jpeg" || $d == "image/png" || $d == "image/gif" || $d == "image/jpg")
    {
        if (is_uploaded_file($_FILES["Image"]["tmp_name"]))
        {
            $x = move_uploaded_file($_FILES["Image"]["tmp_name"],$mappath);

            if($x)
            {
                echo "Foto is toegevoegd! <br>";
                echo "localhost/3sv1/Opdracht/".$mappath;
            }
        }
        else 
        {
            echo "er is iets fout gegaan";
        }
    }
    else 
    {
        echo "Je kan alleen maar jpeg, png, gif en jpg bestanden toevoegen";
    }
}
?>