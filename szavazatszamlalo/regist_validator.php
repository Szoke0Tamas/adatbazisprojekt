<?php

include_once("db.php");

$felhasznalonev = $_POST['felhasznalonev'];
$email = $_POST['e_mail'];
$jelszo = $_POST['jelszo'];
$jelszo_re = $_POST['jelszo_re'];

if ( empty($felhasznalonev) || empty($email) ||
     empty($jelszo) || empty($jelszo_re) ) {
    error_log("Hiányos érték kitöltés");
    header("Location: regist.php?error=Kérjük töltsen ki minden mezőt!");
    exit();
} 

else if($jelszo!=$jelszo_re){ 

    error_log("A két jelszó nem egyezik!");
    header("Location: regist.php?error=A két jelszó nem egyezik");
    exit();

}
else if(user_serach_by_username($felhasznalonev)==true){
    error_log("már használt felhasználóbév");
    header("Location: regist.php?error=A felhasználónév már foglalat");
    exit();
} else{

    user_insert($felhasznalonev,$email,$jelszo);

		header("Location: regist.php?success= Sikeresen regisztráltál");
        exit();
} 
?>