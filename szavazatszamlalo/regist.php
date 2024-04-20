<?php
include_once("db.php");
include("menu.php");
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
<meta charset="UTF-8">    

<h2>
    Üdvözöljük Önt,
    <br>
    amennyiben ÖN már regisztrált felhasználónk jelentkezzen be itt:
    <br>
</h2>
<style>
    h2{
        text-align: center;

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
        font-size:2.5vh;
    }
    label{
        font-weight: 800;

    }
    body{
    padding: 6px;
    background-color: grey;
}
button{
background-color: lightblue;
border: none;
width: 65px;
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
    
}
p2{
    background-color:rgba(0,255,0,0.5);
    display: inline;
    
}

</style>
<?php echo menu2();?>
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

<form method="POST" action="regist_validator.php" accept-charset="utf-8">

<label>Felhasználónév: </label>
<input type="text" name="felhasznalonev" required />
<br>
<label>E-mail cím: </label>
<input type="text" name="e_mail" required/>
<br>
<label>Jelszó: </label>
<input type="password" name="jelszo" required />
<br>
<label>Jelszó újra: </label>
<input type="password" name="jelszo_re" required/>
<br>
<button type="submit">Elküld</button>
</form>


</html>