<?php
include("menu.php");
include("db.php");
?>
<!DOCTYPE html>
<html lang="hu">

<head>
<meta charset="UTF-8">
<h1>Szavazás gyorsan,kényelmesen </h1>
<style>

h1{
    padding: 6px;
    text-align: center;
    background-color: lightgray;
    display:inline;
    align-items: center;
}
input {
        margin: 5px;
        padding: 5px;
        text-align: left;
        display: inline-flex;
        vertical-align: bottom;
        background-color:lightgray;
        font-weight: 800;
        font-size:2.2vh;
    }
    select {
        margin: 5px;
        padding: 5px;
        text-align: left;
        display: inline-flex;
        vertical-align: bottom;
        background-color:lightgray;
        font-weight: 800;
        font-size:2.2vh;
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
form{

  text-align: left;
  font-weight: 800;
}
button{
  font-weight: bold;
  font-size: 20px;
  margin-top: 2px;
}
button:hover{
  opacity: 0.5;
}
p{
    background-color:rgba(250,0,0,0.5);
    display: inline;
    
}
p2{
    background-color:rgba(0,255,0,0.5);
    display: inline;
    
}
.jelezes{
  display: inline;
}


</style>
</head>
<body>
<?php echo menu6();?>
<br><br>

<form method="POST" action="szavaz.php" accept-charset="utf-8">
<br>
<div class="jelezes">
<?php if (isset($_GET['error'])) { ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
    <p2><?php echo $_GET['success']; ?></p2>
    <?php } ?>
<div>

<label>Szavazások: </label>
<select name="szavazasok">
        <?php
        $options = szavazasok_list(); 
        if ($options) {
            echo $options; 
        } else {
            echo "<option value=''>Nincs elérhető szavazás</option>";
        }
        ?>
</select>
<button type="submit">Kiválasztás</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['szavazasok'])) {
            $sz_ID = $_POST['szavazasok'];
            $options2 = jeloltek_per_szavazas($sz_ID); 
            if($options2){
            echo '<form method="POST" action="szavaz_validator.php" accept-charset="utf-8">';
            echo '<input type="hidden" name="szavazas" value="' . $sz_ID . '">';
            echo '<select name =jeloltek>';
            echo $options2;
                } else {
                 echo "<option value=''>Nincs elérhető jelölt</option>";
                  }
            echo '</select><br>';
            echo '<button type="submit">Szavazás</button>';
            echo '</form>';
        }
      
?>

</body>

</html>