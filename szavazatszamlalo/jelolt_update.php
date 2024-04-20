<?php

include_once("db.php");
$j_ID =$_POST['j_ID'];
$j_szuldat3 = $_POST['szuldat3'];
$j_foglalkozas3 =$_POST['foglalkozas3'];
$j_program3 =$_POST['program3'];

$date = strtotime($j_szuldat3);
$szuldate = date('Y-m-d', $date);
$current_timestamp =time();

if ( empty($j_szuldat3)) {
    error_log("Hiányos érték kitöltés");
    header("Location: jelolt.php?error2=Kérjük töltse ki az a dátum mezőt!");
    exit();
} 

else if($date >$current_timestamp){
    error_log("hibás dátum");
    header("Location: jelolt.php?error2=Kérjük adjon meg érvényes dátumokat");
    exit();
}
 else{
    update_jelolt($j_ID,$j_szuldat3,$j_foglalkozas3,$j_program3);

		header("Location: jelolt.php?success2= Sikeres adat frissítés");
        exit();
} 
?>