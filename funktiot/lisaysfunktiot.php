<?php

include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

function lisaaHenkilotiedot(){
    include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
    if(($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST['lisaahenkilo']))){ 
            $katuosoite= $postinumero =$postitoimipaikka= $tiedotPaivitetty= $osoiteid="";
            $henkiloID=$etunimi= $sukunimi= $puhkoti = $sahkoposti = $koeaikaPaattyy = $syntymapaiva =$toihintulopaiva="";

            
            $katuosoite= test_input($_POST["katuosoite"]); 
            $postinumero =test_input($_POST["postinumero"]);
            $postitoimipaikka=test_input($_POST["postitoimipaikka"]);
            $tiedotPaivitetty=test_input($_POST["tiedotPaivitetty"]);
            $etunimi=test_input($_POST["etunimi"]);
            $sukunimi= test_input($_POST["sukunimi"]);
            $puhkoti =test_input($_POST["puhkoti"]);
            $sahkoposti =test_input($_POST["sahkoposti"]);
            $koeaikaPaattyy =test_input($_POST["koeaikaPaattyy"]);
            $syntymapaiva = test_input($_POST["syntymapaiva"]);
            $toihintulopaiva=test_input($_POST["toihintulopaiva"]);
            $osoiteid=0;

            $kysely=$yhteys->prepare("INSERT INTO Yhteystiedot (katuosoite, postinumero, postitoimipaikka, tiedotPaivitetty) VALUES (:katuosoite, :postinumero, :postitoimipaikka, :tiedotPaivitetty)");
            $kysely->bindParam (":katuosoite",$katuosoite);
            $kysely->bindParam (":postinumero",$postinumero);
            $kysely->bindParam (":postitoimipaikka",$postitoimipaikka);
            $kysely->bindParam (":tiedotPaivitetty",$tiedotPaivitetty);
            $kysely->execute ();

            $kysely = $yhteys->prepare("SELECT MAX(osoiteID) FROM Yhteystiedot");
            $kysely->execute();
            $rivi=$kysely->fetch();
                $osoiteid=$rivi['MAX(osoiteID)'];
        
    
    
        $kysely=$yhteys->prepare("INSERT INTO Henkilotiedot(osoiteID, etunimi, sukunimi, puhkoti, sahkoposti, koeaikaPaattyy, syntymapaiva, toihintulopaiva)VALUES (:osoiteID, :etunimi, :sukunimi, :puhkoti, :sahkoposti, :koeaikaPaattyy, :syntymapaiva, :toihintulopaiva)
        ");
        $kysely->bindParam(":osoiteID",$osoiteid);
        $kysely->bindParam(":etunimi",$etunimi);
        $kysely->bindParam(":sukunimi",$sukunimi);
        $kysely->bindParam(":puhkoti",$puhkoti);
        $kysely->bindParam(":sahkoposti",$sahkoposti);
        $kysely->bindParam(":koeaikaPaattyy",$koeaikaPaattyy);
        $kysely->bindParam(":syntymapaiva",$syntymapaiva);
        $kysely->bindParam(":toihintulopaiva",$toihintulopaiva);
        $kysely->execute();
        }      
    }
    
       ?>

<?php

    function muutaMuistamistiedot(){
        include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
        if(($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST['tallennaUuudetMuistamistTiedot']))){ 
            $kukka=$lahja=$sukunimi=$etunimi="";
            $kukka=test_input($_POST['kukka']);
            $lahja=test_input($_POST['lahja']);
            $sukunimi= test_input($_POST["sukunimi"]);
            $etunimi=test_input($_POST["etunimi"]);


            $kysely = $yhteys->prepare("SELECT sukunimi, henkiloID FROM Henkilotiedot WHERE sukunimi=:sukunimi");
            $kysely->bindParam(":sukunimi", $sukunimi);
            $kysely->execute();
            $rivi=$kysely->fetch();
                if($rivi['sukunimi']===$sukunimi){
                $henkiloid=$rivi['henkiloID'];
            }
            
            $kysely=$yhteys->prepare("UPDATE Muistaminen SET kukka=:kukka, lahja=:lahja WHERE henkiloID=:henkiloID");
            $kysely->bindParam(":henkiloID", $henkiloid);
            $kysely->bindParam(":kukka", $kukka);
            $kysely->bindParam(":lahja", $lahja);
            $kysely->execute();
     }
}


?>
