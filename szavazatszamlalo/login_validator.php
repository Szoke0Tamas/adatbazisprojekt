<?php

include_once("db.php");

$felhasznalonev = $_POST['felhasznalonev'];
$jelszo = $_POST['jelszo'];

if ( empty($felhasznalonev) || empty($jelszo) ) {
    error_log("hiányos mezők");
    header("Location: login.php?error=Kérjük töltsen ki minden mezőt!");
    exit();
} 

else if(user_finder($felhasznalonev,$jelszo)===false){
    error_log("hiba minden adattal");
    header("Location: login.php?error=Ön nem regisztrált felhasználónk!");
    exit();
}
else if(user_finder($felhasznalonev,$jelszo)==="j_hiba"){
    error_log("hiba minden adattal");
    header("Location: login.php?error=Ön helytelen jelszót adott meg!");
    exit();
}
else {
    user_last_login($felhasznalonev);
    header("Location: szavazasok.php");
    exit();

}

?>