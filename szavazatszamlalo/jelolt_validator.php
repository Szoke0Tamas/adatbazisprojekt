<?php

include_once("db.php");

$j_felhasznalonev = $_POST['j_felhasznalonev'];
$j_elso_nev = $_POST['j_elso_nev'];
$j_utolso_nev = $_POST['j_utolso_nev'];
$j_szuldat = $_POST['j_szuldat'];
$j_foglalkozas =$_POST['j_foglalkozas'];
$j_program =$_POST['j_program'];

$date = strtotime($j_szuldat);
$szuldate = date('Y-m-d', $date);
$current_timestamp =time();

if ( empty($j_felhasznalonev) || empty($j_elso_nev) ||
     empty($j_utolso_nev) || empty($j_szuldat)) {
    error_log("Hiányos érték kitöltés");
    header("Location: jelolt.php?error=Kérjük töltse ki az első 4 mezőt!");
    exit();
} 

else if($date >$current_timestamp){
    error_log("hibás dátum");
    header("Location: jelolt.php?error=Kérjük adjon meg érvényes dátumot");
    exit();
}
else if(user_serach_by_username($j_felhasznalonev)==false){
    error_log("Nincs ilyen nevű felhasználó");
    header("Location: jelolt.php?error=Nincs ilyen nevű felhasználó");
    exit();    
}
else if(jelolt_search($j_felhasznalonev)==="vanmar"){
    error_log("Nincs ilyen nevű felhasználó");
    header("Location: jelolt.php?error=Már van ilyen jelölt");
    exit();    
    
} else{
    jelolt_insert($j_felhasznalonev,$j_elso_nev,$j_utolso_nev,$szuldate,$j_foglalkozas,$j_program);

		header("Location: jelolt.php?success= Sikeresen jelölt kinevezés!");
        exit();
} 
?>