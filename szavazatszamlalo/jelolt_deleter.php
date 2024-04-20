<?php
include_once("db.php");
$j_elso_nev2 = $_POST['j_elso_nev2'];
$j_utolso_nev2 = $_POST['j_utolso_nev2'];

if (  empty($j_elso_nev2) || empty($j_utolso_nev2)) {
    error_log("Hiányos érték kitöltés");
    header("Location: jelolt.php?error1=Kérjük töltse ki az első az összes mezőt!");
    exit();
}
else if(delete_jelolt($j_elso_nev2,$j_utolso_nev2)==false){
    error_log("Nincsne ilyen jelölt");
    header("Location: jelolt.php?error1=Nincs ilyen jelölt!");
    exit();
}else{
    delete_jelolt($j_elso_nev2,$j_utolso_nev2);
    header("Location: jelolt.php?success1=Sikeres törlés!");
    exit();

}


?>