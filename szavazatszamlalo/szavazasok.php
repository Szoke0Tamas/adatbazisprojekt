<?php
include("menu.php");
include("db.php");
?>
<!DOCTYPE html>
<html lang="hu">
<?php
session_start();
if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']){
    header("Location: index.php");
    exit();
}
?>
<head>
<meta charset="UTF-8">
<h1>Szavazás Managelés</h1>
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
<?php echo menu4();?>
<br><br>

    <?php if (isset($_GET['error'])) { ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
    <p2><?php echo $_GET['success']; ?></p2>
    <?php } ?>

<form method="POST" action="szavazas_validator.php" accept-charset="utf-8">
<label>Szavazás létrehozása</label><br>
<label>Megnevezés: </label>
<input type="text" name="megnevezes" required />
<br>
<label>Leirás: </label>
<input type="text" name="leiras" required/>
<br>
<label>Kezdés időpontja: </label>
<input type="datetime-local" name="kezdes_idopontja" required />
<br>
<label>Zárás időpontja: </label>
<input type="datetime-local" name="zaras_idopontja" required/>
<br>
<button type="submit">Létrehozás</button>
</form>

<form method="POST" action="szavazasok.php" accept-charset="utf-8">
<br>
<div class="jelezes">
<?php if (isset($_GET['error1'])) { ?>
    <p><?php echo $_GET['error1']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success1'])) { ?>
    <p2><?php echo $_GET['success1']; ?></p2>
    <?php } ?>
<div>
<label>Szavazás Módosítása</label>
<br>
<label>Szavazásai: </label>
<select name="mod">
        <?php
        $options = users_votings_list(); 
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mod'])) {
            $sza_ID = $_POST['mod'];
            $data = users_votingdata_by_megnevezes($sza_ID);
            if($data){
            echo '<form method="POST" action="szavazasok_update.php" accept-charset="utf-8">';
            echo '<input type="hidden" name="sza_ID" value="' . $sza_ID . '">';
            echo '<label>Leírás: </label><input type="text" name="leiras" value="' . $data['leiras'] . '" /><br>';
            echo '<label>Kezdés időpontja: </label><input type="datetime-local" name="kezdes_idopontja" value="' . $data['kezdes_idopontja'] . '" /><br>';
            echo '<label>Zarás időpontja: </label><input type="datetime-local" name="zaras_idopontja" value="' . $data['zaras_idopontja'] . '" /><br>';
            echo '<button type="submit">Mentés</button>';
            echo '</form>';
            }
      }
?>


<form method="POST" action="szavazashoz_jelolt.php" accept-charset="utf-8">
<br>
<div class="jelezes">
<?php if (isset($_GET['error2'])) { ?>
    <p><?php echo $_GET['error2']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success2'])) { ?>
    <p2><?php echo $_GET['success2']; ?></p2>
    <?php } ?>
<div>
<label> jelölt hozzáadása szavazáshoz</label>
<br>
<label>Szavazásai: </label>
<select name="szavazas">
        <?php
        $options2 = users_votings_list(); 
        if ($options2) {
            echo $options2; 
        } else {
            echo "<option value=''>Nincs elérhető szavazás</option>";
        }
        ?>
</select>
<br>
<label>Jelöltek: </label>
<select name="jeloltek">
        <?php
        $options3 = jeloltek_list(); 
        if ($options3) {
            echo $options3; 
        } else {
            echo "<option value=''>Nincs jelölt</option>";
        }
        ?>
</select>
<br>
<button type="submit">Hozzáadás</button>
</form>

<form method="POST" action="szavazasok.php" accept-charset="utf-8">
<br>
<div class="jelezes">
<?php if (isset($_GET['error3'])) { ?>
    <p><?php echo $_GET['error3']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success3'])) { ?>
    <p2><?php echo $_GET['success3']; ?></p2>
    <?php } ?>
<div>
<label> jelölt visszaléptetése</label>
<br>
<label>Szavazásai: </label>
<select name="szavazas">
        <?php
        $options4 = users_votings_list(); 
        if ($options4) {
            echo $options4; 
        } else {
            echo "<option value=''>Nincs elérhető szavazás</option>";
        }
        ?>
</select>
<button type="submit">Kiválasztás</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['szavazas'])) {
            $sz_ID = $_POST['szavazas'];
            $options5 = jeloltek_per_szavazas($sz_ID); 
            if($options5){
            echo '<form method="POST" action="szavazashoz_jelolt_deleter.php" accept-charset="utf-8">';
            echo '<input type="hidden" name="szavazas" value="' . $sz_ID . '">';
            echo '<select name =jeloltek>';
            echo $options5;
                } else {
                 echo "<option value=''>Nincs elérhető jelölt</option>";
                  }
            echo '</select><br>';
            echo '<button type="submit">Visszaléptetés</button>';
            echo '</form>';
        }
      
?>

</body>


</html>