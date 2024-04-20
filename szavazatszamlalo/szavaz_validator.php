<?php

include_once("db.php");

$sz_ID = $_POST['szavazas'];
$j_ID = $_POST['jeloltek'];


if ( empty($sz_ID) || empty($j_ID)) {
    error_log("hiányos mezők");
    header("Location: szavaz.php?error=Kérjük töltsen ki minden mezőt!");
    exit();
} 
else if(user_already_voted($j_ID,$sz_ID)==false){
    error_log("Már szavazott");
    header("Location: szavaz.php?error=Ön már szavazott!");
    exit();
}
else if(szavaz_insert($sz_ID,$j_ID)==="vege" ){
    error_log("lejárt a szavazás");
    header("Location: szavaz.php?error=Vége a szavazásnak már nem tud szavazni!");
    exit();
}
else {
    header("Location: szavaz.php?success=Sikeres szavazás!");
    exit();

}

?>