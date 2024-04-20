<?php

include_once("db.php");

$szavazas =$_POST['szavazas'];
$jelolt = $_POST['jeloltek'];

if ( empty($szavazas) || empty($jelolt) ) {
    error_log("hiányos mezők");
    header("Location: szavazasok.php?error3=Kérjük töltsen ki minden mezőt!");
    exit();
} 
else {
    indul_delete($szavazas,$jelolt);
    header("Location: szavazasok.php?success3=Sikeres visszaléptetés!");
    exit();

}

?>