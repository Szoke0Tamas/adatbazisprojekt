<?php

include_once("db.php");

$szavazas =$_POST['szavazas'];
$jelolt = $_POST['jeloltek'];

if ( empty($szavazas) || empty($jelolt) ) {
    error_log("hiányos mezők");
    header("Location: szavazasok.php?error2=Kérjük töltsen ki minden mezőt!");
    exit();
} 
else if(indul_insert($szavazas,$jelolt)==false){
    error_log("Már hozzá van rendelve");
    header("Location: szavazasok.php?error2=Ez a jelölt már részt vesz ezen a szavazáson!");
    exit();

}
else {
    indul_insert($szavazas,$jelolt);
    header("Location: szavazasok.php?success2=Sikeres kinevezés!");
    exit();

}

?>