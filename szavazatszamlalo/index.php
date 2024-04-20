<?php
include("menu.php");
include_once("db.php");
?>
<!DOCTYPE html>
<html lang="hu">
   

<head>
<meta charset="UTF-8">

    <div class="cimek">
<h1> Üdvözöllek!</h1>
<h2>Gyere szavazz velünk!</h2>
</div>
<style>

.cimek{
    padding: 1px;
    text-align: center;
    background-color: lightgray;
    border-radius: 60%;

}
a {
  color: inherit;
  text-decoration: none; 
  background-color: lightgray;
  padding: 2px;
}
body{
    background-color: grey;
}

</style>
</head>
<body>

</body>
<?php echo menu();?>
<br>
<?php
if(szavazasok_adatai()==false){
 echo "Nincs kiírt szavazaás!";
}else{
    echo "<table border='2'>";
    echo "<tr><th>Megnevezes</th><th>Leírás</th><th>Kezdés időpontja</th><th>Zárás időpontja</th><th>Jelöltek:</th><th>Szavazatok:</th></tr>";
    $run =szavazasok_adatai();
    while ($row = mysqli_fetch_assoc($run)) {
    
        echo "<tr>";
        echo "<td>" . $row['megnevezes'] . "</td>";
        echo "<td>" . $row['leiras'] . "</td>";
        echo "<td>" . $row['kezdes_idopontja'] . "</td>";
        echo "<td>" . $row['zaras_idopontja'] . "</td>";
        echo "<td>" . $row['elso_nev'] ." " . $row['utolso_nev'] . "</td>";
        echo "<td>" . $row['szavazatok'] . "</td>";      
        echo "</tr>";
    }
    
    echo "</table>";
}
?>
</HTml>