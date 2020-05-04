<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel= "stylesheet" type="text/css" href="/henkkis/resurssit/tyylit.css">
    <title>Rekisteröidy</title>
</head>
<body>


<!-- header -->
<div>
 </div>
 <div class="tausta">
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <!-- <h3>Column 1</h3> -->
      
    </div>
  <!-- keskimmäinen joka tulee ekaksi -->
    <div class="col-sm-6">
      <img src="/henkkis/resurssit/logo.jpg" alt="logo"> 
      <h4> Henkkis henkilöstöhallinnon yhteyshenkilöt yrityksessänne ovat: <h4>
        <p>Pääkäyttäjä: Ville Velho 040-1257822</p>
        <p>Tekninen tuki: 0500-75214</p>
    </div>
<div>
 </div>
 <div class="tausta">
<div class="container">
  <div class="row">
    <div class="col-sm-4">

    </div>
    <div class="col-sm-5">

        <!-- Lomake jolla henkilö lisätään: -->


  <h1> Rekisteröi uusi käyttäjä palveluun</h1> <br>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <!-- name oli tunnus aikaisemmin -->
  Etunimi <br>
  <input type="text" name="etunimi" required> <br> 
  Sukunimi <br>
  <input type="text" name="sukunimi" required> <br> 
  Nimike <br>
  <input type="text" name="nimike" required> <br> 
  Tunnus <br>
  <input type="text" name="tunnus" required> <br> 
  Salasana<br>
   <input type="text" name="salasana" required> <br>
  Salasana uudelleen<br>
   <input type="text" name="salasana2" required>
  <br>
  <br>
  <br>
  <p> Henkilöstön tietojen suojelemiseksi rekisteröitymiseen tarvitaan pääkäyttäjän oikeudet. Täytäthän myös alla olevat tiedot. </p>
  Pääkäyttäjän tunnus <br>
  <input type="text" name="pktunnus" required> <br>
  Pääkäyttäjän salasana <br>
  <input type="text" name="pksala" required> <br>
  <input type="submit" name="laheta" value="Lähetä tiedot">
</form>


  
     </div>
<?php
//luodaan tietokantayhteys:
include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysKirjautuminen.php");
//lomakkeen validointi:
$etunimi=$sukunimi=$nimike=$tunnus=$salasana=$salasana2="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etunimi = test_input($_POST["etunimi"]); 
    $sukunimi = test_input($_POST["sukunimi"]); 
    $nimike = test_input($_POST["nimike"]); 
    $tunnus = test_input($_POST["tunnus"]); 
    $sala = test_input($_POST["salasana"]);
    $sala2 = test_input($_POST["salasana2"]);
    $pktunnus=test_input($_POST["pktunnus"]);
    $pksala=test_input($_POST["pksala"]);
    //kryptaus
    $salt="k1su4vGetRpw6nit59thq";
    $salasana=crypt($sala,$salt);
    $salasana2=crypt($sala2,$salt);
   }

function test_input($data) {
  $data = trim($data);//poistaa välit
  $data = htmlspecialchars($data);//muuttaa html-elementit
  return $data;
}
?>
<?php

// if(isset($_REQUEST['laheta']) && $salasana===$salasana2){
   if(isset($_REQUEST['laheta'])){
    if($salasana===$salasana2){
    $kysely=$yhteys->prepare("INSERT INTO salakoodit (etunimi, sukunimi, nimike, tunnus, salasana) VALUES (:etunimi, :sukunimi, :nimike, :tunnus, :salasana)");
    $kysely->bindParam(":etunimi", $etunimi);
    $kysely->bindParam(":sukunimi", $sukunimi);
    $kysely->bindParam(":nimike", $nimike);
    $kysely->bindParam(":tunnus", $tunnus);
    $kysely->bindParam(":salasana", $salasana);
    $kysely->execute();
}
}

?>
<?php
if(isset($_REQUEST['laheta'])&& (!(empty($tunnus))) && $salasana===$salasana2 && $pktunnus==='admin' && $pksala==='sala'){
  $_SESSION['sessio']=$_REQUEST['tunnus'];
    header("location:etusivu.php");

    
}
?>

</body>
</html>