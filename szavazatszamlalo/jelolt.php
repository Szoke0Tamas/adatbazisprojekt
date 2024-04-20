<?php
include_once("db.php");
include("menu.php");
?>
<!DOCTYPE html>
<html lang="hu">

<head>
<meta charset="UTF-8">    

<h2>
    Új jelölt kinevezése,adatainak módosítása,törlése?
    Itt mindent megoldhat egy helyen!

</h2>
<br><br>
<style>
h2{
    padding: 2px;
    background-color: lightgray;
    display:inline;
}
    a {
        color: inherit;
        text-decoration: none; 
        background-color: lightgray;
        padding: 2px;
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
    label{
        font-weight: 800;

    }
    body{
    padding: 6px;
    background-color: grey;
}
button{
background-color: lightgrey;
border: none;
width: 120px;
height: 40px;
font-weight: 800;
font-size: 2.5vh;
padding: 3px;

}
button:hover{
    opacity: 0.5;
}
p{
    background-color:rgba(250,0,0,0.5);
    display: inline;
    text-align: left;
    
}
p2{
    background-color:rgba(0,255,0,0.5);
    display: inline;
    text-align: left;
    
}
form{

text-align: left;
font-weight: 800;
}
.c {
background-color:rgba(100,100,100,0.7);
display: inline;
padding: 3px;
margin-left: 2%;

}
select{
    margin: 5px;
    padding: 3px;
    display: inline-flex;
    vertical-align: bottom;
    background-color:lightgray;
    font-weight: 800;
    font-size:2.2vh;
}
.jelezes{
    display: inline;
}

</style>
<?php echo menu5();?>
<br>
<br>
<?php
 if (isset($_GET['error'])) { ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
    <p2><?php echo $_GET['success']; ?></p2>
    <?php } ?>
</head>
<form method="POST" action="jelolt_validator.php" accept-charset="utf-8">
<div class="c">
<label>Új jelölt felvétele</label><br>
</div>
<label>Jelölt felhasználóneve: </label>
<input type="text" name="j_felhasznalonev" required />
<br>
<label>Jelölt első neve: </label>
<input type="text" name="j_elso_nev" required/>
<br>
<label>Jelölt utolsó neve: </label>
<input type="text" name="j_utolso_nev" required />
<br>
<label>Jelölt születési dátuma: </label>
<input type="date" name="j_szuldat" />
<br>
<label>Jelölt foglalkozása: </label>
<input type="text" name="j_foglalkozas" />
<br>
<label>Jelölt programja: </label>
<input type="text" name="j_program" />
<br>
<button type="submit">Kinevezés</button>
</form>

<?php
 if (isset($_GET['error1'])) { ?>
    <p><?php echo $_GET['error1']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success1'])) { ?>
    <p2><?php echo $_GET['success1']; ?></p2>
    <?php } ?>
<form method="POST" action="jelolt_deleter.php" accept-charset="utf-8">
 <br><div class="c">
<label>Jelölt törlése</label><br>
</div>
<label>Jelölt első neve: </label>
<input type="text" name="j_elso_nev2" required/>
<br>
<label>Jelölt utolsó neve: </label>
<input type="text" name="j_utolso_nev2" required />
<br>
<button type="submit">Törlés</button>
</form>
<br>
<div class="jelezes">
<?php if (isset($_GET['error2'])) { ?>
    <p><?php echo $_GET['error2']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success2'])) { ?>
    <p2><?php echo $_GET['success2']; ?></p2>
    <?php } ?>
<div>

<form method="POST"  action="jelolt.php" accept-charset="utf-8">
<div class="c">
<label>Jelölt adatainak módosítása</label>
<div>
<br>
<label>Jelöltek: </label>
<select name="value">
        <?php
        $options = jeloltek_list(); 
        if ($options) {
            echo $options; 
        } else {
            echo "<option value=''>Nincs jelölt</option>";
        }
        ?>
</select>
<button type="submit">Kiválasztás</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['value'])) {
            $j_ID = $_POST['value'];
            $data = jelolt_adatai_list($j_ID); 
            if($data){
            echo '<form method="POST" action="jelolt_update.php" accept-charset="utf-8">';
            echo '<input type="hidden" name="j_ID" value="' . $j_ID . '">';
            echo '<label>Születési dátum: </label><input type="date" name="szuldat3" value="' . $data['szuletesi_datum'] . '" /><br>';
            echo '<label>Foglakozás: </label><input type="text" name="foglalkozas3" value="' . $data['foglalkozas'] . '" /><br>';
            echo '<label>Program: </label><input type="text" name="program3" value="' . $data['program'] . '" /><br>';
            echo '<button type="submit">Mentés</button>';
            echo '</form>';
        }
      }
?>
</html>