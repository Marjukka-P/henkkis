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
    <title>Hakusivu</title>
</head>
<body>


<!-- header -->
<!-- <div>
 </div> -->
 <div class="tausta">
<div class="tausta">
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <!-- <h3>Column 1</h3> -->
    </div>
  <!-- keskimmäinen joka tulee ekaksi -->
    <div class="col-sm-6">
      <img src="/henkkis/resurssit/logo.jpg" alt="logo" title="logo"> 
    </div>

    <div class="col-sm-3">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 			 -->
        <input type="submit" name="lopeta" value="Kirjaudu ulos"/>			
        </form>			
    </div>
  </div>
</div>
</div>

 <div class="tausta">
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <!-- <h3>Column 1</h3> -->
  
<!-- LOMAKE JOLLA HAETAAN -->

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <input type="submit" name="lisaahenkilotiedot" value="Lisää uusi työntekijä">
        </form>

        <!-- <form method="post" action='muistaminen.php'>  -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <input type="submit" name="haeMuistaminen" value="Hae tiedot muistamislahjoista">
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <input type="submit" name="haeSyntymapaivat" value="Hae tiedot syntymäpäivistä">
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <input type="submit" name="haeYhteystiedot" value="Hae työntekijöiden yhteystiedot">
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        <input type="submit" name="muokkaaMuistaminen" value="Muokkaa työntekijöiden muistamisia">
        </form>

        <form>
        <input type="submit" name="tyhjenna" value="Tyhjennä tiedot">
        </form>
    </div>
  <!-- keskimmäinen joka tulee ekaksi -->
  <div class="tausta">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">

        <!-- Lomake jolla henkilö lisätään: -->
    <?php
        if (isset($_REQUEST['lisaahenkilotiedot'])){ ?>
        <h1>Lisää työntekijän yhteystiedot </h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
         Etunimi: <br>
         <input name="etunimi" title="etunimi"><br>
         Sukunimi: <br>
         <input name="sukunimi" title="sukunimi"><br>
         Katuosoite: <br>
         <input type="text" name="katuosoite" title="katuosoite"> <br>
         Postinumero: <br>
         <input type="text" name="postinumero" title="postinumero"> <br>
         Postitoimipaikka: <br>
         <input type="text" name="postitoimipaikka" title="postitoimipaikka"> <br>
         Puhelin kotiin: <br>
         <input name="puhkoti" title="puhkoti"><br>
         Sähköposti: <br> 
         <input name="sahkoposti" title="sahkoposti"><br>
         Koeaika päättyy: <br>
         <input name="koeaikaPaattyy" title="koeaika paattyy"><br>
         Syntymäpäivä (vv-kk-pv) <br>
         <input name="syntymapaiva" title="syntymapäivä"><br>
         Töihintulopäivä (vv-kk-pv): <br> 
         <input name="toihintulopaiva" title="töihiintulopäivä"><br>
         Tiedot päivitetty: <br>
         <input name="tiedotPaivitetty" title="tiedot päivitetty"><br>
         <br>
         <input type="submit" name="lisaahenkilo" value="Lisää tiedot">  
         </form> 
         <?php
         } 
        ?>

<?php
        if (isset($_REQUEST['muokkaaMuistaminen'])){ ?>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        Työntekijän sukunimi<br>
        <input type="text" name="sukunimi"> <br>
          <input type="submit" name="haeMuistamisTiedot" value="Hae tiedot">  
         </form> 
         <?php
         } 
?>

      <!-- Kutsutaan funktioita jotka tulostavat tiedot -->
    <?php
          include("/xampp/htdocs/henkkis/funktiot/hakufunktiot.php");
          include("/xampp/htdocs/henkkis/funktiot/lisaysfunktiot.php");

          if(isset($_REQUEST['haeMuistaminen'])){
              haeMuistaminen();
          }
          if(isset($_REQUEST['haeSyntymapaivat'])){
              haeSyntymapaivat();
          }
          if(isset($_REQUEST['haeYhteystiedot'])){
            haeYhteystiedot();
         }
          if (isset($_REQUEST['tyhjenna'])){
            echo "";
          }
          if(isset($_REQUEST['lopeta'])){
          lopeta();
          }
          if(isset($_REQUEST['haeMuistamisTiedot'])){
            haeMuistaminenMuutettavaksi();
          }
          if(isset($_REQUEST['tallennaUuudetMuistamistTiedot'])){
            muutaMuistamistiedot();
          }
          if(isset($_REQUEST['lisaahenkilo'])){
          lisaaHenkilotiedot();
          }
    ?>
    </div>
  </div>
</div>
</div>

</body>
</html>