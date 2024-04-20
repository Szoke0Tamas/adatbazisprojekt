<?php

include_once("db.php");
$sza_ID =$_POST['sza_ID'];
$leiras = $_POST['leiras'];
$kezdes_idopontja =$_POST['kezdes_idopontja'];
$zaras_idopontja =$_POST['zaras_idopontja'];

$timestamp = strtotime($kezdes_idopontja);
$timestamp2 = strtotime($zaras_idopontja);
$timestamp_alak = date('Y-m-d H:i:s', $timestamp);
$timestamp_alak2 = date('Y-m-d H:i:s', $timestamp2);
$current_timestamp =time();

if ( empty($sza_ID) || empty($leiras) || !isset($_POST['kezdes_idopontja']) || !isset($_POST['zaras_idopontja']) ) {
    error_log("hiányos mezők");
    header("Location: szavazasok.php?error1=Kérjük töltsen ki minden mezőt!");
    exit();
} 
else if($timestamp2 <$current_timestamp ){
    error_log("hibás dátumok");
    header("Location: szavazasok.php?error1=Kérjük adjon meg érvényes dátumokat");
    exit();
}
else if($timestamp > $timestamp2){
    error_log("hibás dátumok nagysága");
    header("Location: szavazasok.php?error1=Kérjük adjon meg a kezdéshez képest későbbi Zárás időpontot!");
    exit();
}
else {
    update_voting($sza_ID,$leiras,$timestamp_alak,$timestamp_alak2);
    header("Location: szavazasok.php?success1=Sikeres módosítás!");
    exit();

}

?>