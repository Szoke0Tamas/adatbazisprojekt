<?php
function csatlkaozas(){
$conn = new mysqli("localhost", "root", "", "szavazatszamlalo");

mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET NAMES 'utf8mb4'");
mysqli_real_connect($conn,"localhost", "root", "", "szavazatszamlalo");

if(!$conn){
    echo "hiba van sandorom";
    die("csatlkaozási hiba...");
    return false;
}
return $conn;
}
function user_insert($felhasznalonev,$email,$jelszo){
    if(!csatlkaozas()){
        return false;
    }
    $conn=csatlkaozas();
    $hashed_jelszo = password_hash($jelszo, PASSWORD_BCRYPT);
    $pre =mysqli_prepare($conn, "INSERT INTO felhasznalo(felhasznalonev,email,jelszo) VALUES (?,?,?)");

	mysqli_stmt_bind_param($pre, "sss", $felhasznalonev, $email, $hashed_jelszo);
	
	$executed = mysqli_stmt_execute($pre); 
		
	mysqli_close($conn);
	return $executed;

}
function user_serach_by_username($felhasznalonev){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $pre = mysqli_prepare($conn, "SELECT felhasznalonev FROM felhasznalo WHERE felhasznalonev = ?");
    mysqli_stmt_bind_param($pre, "s", $felhasznalonev);
    $executed = mysqli_stmt_execute($pre);
    
    if ($executed) {
        $result = mysqli_stmt_get_result($pre);

        if (mysqli_num_rows($result) > 0) {
            mysqli_close($conn);
            return true;
        } else {
            mysqli_close($conn);
            return false;
        }
    } else {
        mysqli_close($conn);
        return "error";
    }
}

function user_finder($felhasznalonev,$jelszo){
if(!csatlkaozas()){
    return "error";
}
session_start();
$conn = csatlkaozas();
$run =mysqli_query($conn, "SELECT ID,felhasznalonev,jelszo FROM felhasznalo WHERE felhasznalonev='$felhasznalonev'");

    if (mysqli_num_rows($run) > 0) {
        $row =mysqli_fetch_assoc($run);
        if(password_verify($jelszo,$row['jelszo'])){
            $_SESSION['loggedin'] =true;
            $_SESSION['felhasznalonev'] =$row['felhasznalonev'];
            $_SESSION['user_ID'] = $row['ID'];
            mysqli_close($conn);
            return true;
        } else {
        mysqli_close($conn);
        return "j_hiba";
        }
    }else{
        mysqli_close($conn);
        return false;
    }


}

function user_last_login($felhasznalonev){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $pre = mysqli_prepare($conn, "UPDATE felhasznalo SET utolsobelepes=CURRENT_TIMESTAMP() WHERE felhasznalonev =?");
    mysqli_stmt_bind_param($pre, "s", $felhasznalonev);
    $executed = mysqli_stmt_execute($pre);
    if($executed){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;

    }

}

function szavazas_insert($megnevezes,$leiras,$timestamp_alak,$timestamp_alak2){
    if(!csatlkaozas()){
        return "error";
    }
    session_start();
    $conn = csatlkaozas();
    $pre = mysqli_prepare($conn, "INSERT INTO szavazas(kiiro_ID,megnevezes,leiras,kezdes_idopontja,zaras_idopontja) VALUES(?,?,?,?,?)");
    mysqli_stmt_bind_param($pre, "issss", $_SESSION['user_ID'],$megnevezes,$leiras,$timestamp_alak,$timestamp_alak2);
    $executed = mysqli_stmt_execute($pre);
    mysqli_close($conn);
	return $executed;


}

function users_votings_list(){
    if(!csatlkaozas()){
        return "error";
    }
    session_start();
    $conn = csatlkaozas();
    $fh_ID =$_SESSION['user_ID'];
    $run =mysqli_query($conn,"SELECT ID,megnevezes,leiras,kezdes_idopontja,zaras_idopontja FROM szavazas WHERE kiiro_ID=$fh_ID");
    
    if(mysqli_num_rows($run) > 0){
        $options="";
        while ($row = mysqli_fetch_assoc($run)) {
            $options .= "<option value='" . $row['ID'] . "'>" . $row['megnevezes'] . "</option>";
        }
        mysqli_close($conn);
        return $options;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function users_votingdata_by_megnevezes($sza_ID){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT megnevezes,leiras,kezdes_idopontja,zaras_idopontja FROM szavazas WHERE ID='$sza_ID'");
    
    if(mysqli_num_rows($run) > 0){
        $row =mysqli_fetch_assoc($run);
        mysqli_close($conn);
        return $row;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function update_voting($sza_ID,$leiras,$timestamp_alak,$timestamp_alak2){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $pre = mysqli_prepare($conn, "UPDATE szavazas SET leiras=?,kezdes_idopontja=?,zaras_idopontja=? WHERE ID=?");
    mysqli_stmt_bind_param($pre, "ssss",$leiras,$timestamp_alak,$timestamp_alak2,$sza_ID);
    $executed = mysqli_stmt_execute($pre);
    if($executed){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function jelolt_search($j_felhasznalonev){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn, "SELECT ID,felhasznalonev FROM felhasznalo WHERE felhasznalonev='$j_felhasznalonev'");

    if(mysqli_num_rows($run) > 0){
        $row =mysqli_fetch_assoc($run);
        $f_ID =$row['ID'];
    }else{
        mysqli_close($conn);
        return false;

    }
    $run2 =mysqli_query($conn, "SELECT f_ID FROM jelolt WHERE f_ID='$f_ID'");
    if(mysqli_num_rows($run2) > 0){
        mysqli_close($conn);
        return "vanmar";
    }else{
        mysqli_close($conn);
        return true;
    }

}
function jelolt_insert($j_felhasznalonev,$j_elso_nev,$j_utolso_nev,$szuldate,$j_foglalkozas,$j_program){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn, "SELECT ID,felhasznalonev FROM felhasznalo WHERE felhasznalonev='$j_felhasznalonev'");
    $row =mysqli_fetch_assoc($run);
    $f_ID =$row['ID'];
    $pre =mysqli_prepare($conn,"INSERT INTO jelolt(f_ID,elso_nev,utolso_nev,szuletesi_datum,foglalkozas,program) VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($pre,"isssss", $f_ID,$j_elso_nev,$j_utolso_nev,$szuldate,$j_foglalkozas,$j_program);
    $executed = mysqli_stmt_execute($pre);
    mysqli_close($conn);
    return true;

}

function delete_jelolt($j_elso_nev2,$j_utolso_nev2){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn, "SELECT elso_nev,utolso_nev FROM jelolt WHERE elso_nev='$j_elso_nev2' AND utolso_nev='$j_utolso_nev2'");
    
    if(mysqli_num_rows($run) > 0){
    }else{
        mysqli_close($conn);
        return false;

    }
    $pre =mysqli_prepare($conn,"DELETE FROM jelolt WHERE elso_nev=? AND utolso_nev=?");
    mysqli_stmt_bind_param($pre,"ss",$j_elso_nev2,$j_utolso_nev2);
    $executed = mysqli_stmt_execute($pre);
    mysqli_close($conn);
    return true;

}
function jeloltek_list(){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT f_ID,elso_nev,utolso_nev FROM jelolt");
    
    if(mysqli_num_rows($run) > 0){
        $options="";
        while ($row = mysqli_fetch_assoc($run)) {
            $options .= "<option value='" . $row['f_ID'] . "'>" . $row['elso_nev'] ." " . $row['utolso_nev'] . "</option>";
        }
        mysqli_close($conn);
        return $options;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function jelolt_adatai_list($j_ID){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT szuletesi_datum,foglalkozas,program FROM jelolt WHERE f_ID=$j_ID");
    
    if(mysqli_num_rows($run) > 0){
        $row =mysqli_fetch_assoc($run);
        mysqli_close($conn);
        return $row;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function update_jelolt($j_ID,$j_szuldat3,$j_foglakozas3,$j_program3){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $pre = mysqli_prepare($conn, "UPDATE jelolt SET szuletesi_datum=?,foglalkozas=?,program=? WHERE f_ID=?");
    mysqli_stmt_bind_param($pre, "sssi",$j_szuldat3,$j_foglakozas3,$j_program3,$j_ID);
    $executed = mysqli_stmt_execute($pre);
    if($executed){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;

    }
}
function indul_insert($szavazas,$jelolt){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT j_ID,sz_ID FROM indul WHERE j_ID=$jelolt AND sz_ID=$szavazas");
    
    if(mysqli_num_rows($run) > 0){

        mysqli_close($conn);
        return false;
    }else{

    $pre =mysqli_prepare($conn,"INSERT INTO indul(j_ID,sz_ID) VALUES (?,?)");
    mysqli_stmt_bind_param($pre,"ii", $jelolt,$szavazas);
    $executed = mysqli_stmt_execute($pre);
    mysqli_close($conn);
    return true;
    }
}

function jeloltek_per_szavazas($sz_ID){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT j_ID,sz_ID FROM indul WHERE sz_ID=$sz_ID");
    
    if(mysqli_num_rows($run) > 0){
    $run2 =mysqli_query($conn,"SELECT jelolt.f_ID,indul.sz_ID,jelolt.elso_nev,jelolt.utolso_nev FROM indul INNER JOIN jelolt ON indul.j_ID =jelolt.f_ID WHERE indul.sz_ID=$sz_ID ORDER BY jelolt.elso_nev ASC");
    $options="";
    while ($row = mysqli_fetch_assoc($run2)) {
        $options .= "<option value='" . $row['f_ID'] . "'>" . $row['elso_nev'] ." " . $row['utolso_nev'] . "</option>";
    }
        mysqli_close($conn);
        return $options;
    }else{
        mysqli_close($conn);
        return false;
    }

}


function indul_delete($szavazas,$jelolt){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $pre =mysqli_prepare($conn,"DELETE FROM indul WHERE j_ID=? AND sz_ID=?");
    mysqli_stmt_bind_param($pre,"ii", $jelolt,$szavazas);
    $executed = mysqli_stmt_execute($pre);
    mysqli_close($conn);
    return true;

}

function szavazasok_adatai(){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT * ,COUNT(szavaz.j_ID) AS szavazatok FROM indul
     LEFT JOIN jelolt ON indul.j_ID =jelolt.f_ID 
     LEFT JOIN szavazas ON indul.sz_ID = szavazas.ID
     LEFT JOIN szavaz ON indul.j_ID = szavaz.j_ID
     GROUP BY szavazas.ID,indul.j_ID
     ORDER BY szavazas.megnevezes ASC");
    
    if(mysqli_num_rows($run) > 0){
        mysqli_close($conn);
        return $run;
    }else{
        mysqli_close($conn);
        return false;
    }
}
function szavazasok_list(){
    if(!csatlkaozas()){
        return "error";
    }
    $conn = csatlkaozas();
    $run =mysqli_query($conn,"SELECT ID,megnevezes FROM szavazas");
    
    if(mysqli_num_rows($run) > 0){
        $options="";
        while ($row = mysqli_fetch_assoc($run)) {
            $options .= "<option value='" . $row['ID'] . "'>" . $row['megnevezes'] . "</option>";
        }
        mysqli_close($conn);
        return $options;
    }else{
        mysqli_close($conn);
        return false;

    }
}

function szavaz_insert($sz_ID,$j_ID){
    if(!csatlkaozas()){
        return "error";
    }
    session_start();
    $conn = csatlkaozas();
    $fh_ID =$_SESSION['user_ID'];
    $run =mysqli_query($conn,"SELECT ID,zaras_idopontja FROM szavazas WHERE ID ='$sz_ID'");

    if(mysqli_num_rows($run) >0){
    $row =mysqli_fetch_assoc($run);
    $z_i = strtotime($row['zaras_idopontja']);
        if(time()>$z_i){
        mysqli_close($conn);
        return "vege";
        }else{

        $pre =mysqli_prepare($conn,"INSERT INTO szavaz(f_ID,j_ID,sz_ID) VALUES (?,?,?)");
        mysqli_stmt_bind_param($pre,"iii", $fh_ID,$j_ID,$sz_ID);
        $executed = mysqli_stmt_execute($pre);
        mysqli_close($conn);
        return true; 
    }
    }else {
        mysqli_close($conn);
        return false;
    }
}

function user_already_voted($j_ID,$sz_ID){
    if(!csatlkaozas()){
        return "error";
    }
    session_start();
    $conn = csatlkaozas();
    $fh_ID =$_SESSION['user_ID'];
    $run =mysqli_query($conn,"SELECT f_ID,sz_ID FROM szavaz WHERE f_ID ='$fh_ID' AND sz_ID ='$sz_ID'");

    
    if(mysqli_num_rows($run) >0){
        mysqli_close($conn);
        return false;
    }else {
        mysqli_close($conn);
        return true;
    }

}