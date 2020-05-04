<?php

function lopeta(){
    if(($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_REQUEST['lopeta']))){ // jos painetaan haeMuistaminen
            session_unset();//vapauttaa sessio-muuttujan
            session_destroy();//poistaa kaiken datan
            header("location: etusivu.php");//ajaa ekasivu.php:n
        }
    }


?>

<?php
function haeMuistaminen(){
    //liitetään tiedosto tietokantayhteys, joka ottaa yhteyden tietokantaan
    include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
        if(($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_REQUEST['haeMuistaminen']))){ // jos painetaan haeMuistaminen
            //prepare valmistelee sql kyselyn suorittamista varten
            $kysely = $yhteys->prepare("SELECT etunimi, sukunimi, kukka, lahja FROM henkilotiedot JOIN muistaminen ON henkilotiedot.henkiloID = muistaminen.henkiloID
            ORDER BY sukunimi");  //haetaan tarvittavat tiedot
            $kysely->execute();//suorttaa kyselyn joka on valmisteltu prepare-funktiolla
            echo "<h4>Henkilöstön muistaminen sukunimen mukaan järjestettynä</h2>"; 
	        echo "<table><tr><th>Etunimi</th> <th>Sukunimi</th><th>Kukka</th><th>Lahja</th>"; //tulostetaan taulukon otsikkorivi

            while ($rivi = $kysely->fetch()) { // käydään kaikki tulosjoukon rivit läpi. $rivi on taulukon yksi rivi eli yhden henkilän tiedot
                echo "<tr><td>" . $rivi['etunimi'] ."</td><td>" . $rivi['sukunimi'] . "</td><td>"  . $rivi['kukka'] . "</td><td>"  . $rivi['lahja'] . "</td></tr>"; //tulostetaan rivin kentät selaimelle
                "</table>";
            }

         }
    }
            
?> 

<?php
    function haeSyntymapaivat(){
        
        include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
        if(($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_REQUEST['haeSyntymapaivat']))){
            //prepare valmistelee sql kyselyn suorittamista varten
            $kysely = $yhteys->prepare("SELECT etunimi, sukunimi, syntymapaiva FROM henkilotiedot ORDER BY month(syntymapaiva)");  //haetaan tarvittavat tiedot
            $kysely->execute();//suorttaa kyselyn joka on valmisteltu prepare-funktiolla
            echo "<h4>Henkilöstön syntymäpäivät syntymäkuukauden mukaan järjestettynä</h2>";
	        echo "<table><tr><th>Etunimi</th> <th>Sukunimi</th><th>Syntymäpäivä</th>";

            while ($rivi = $kysely->fetch()) { // käydään kaikki tulosjoukon rivit läpi. $rivi on taulukon yksi rivi eli yhden henkilän tiedot
                echo "<tr><td>" . $rivi['etunimi'] ."</td><td>" . $rivi['sukunimi'] . "</td><td>"  . $rivi['syntymapaiva'] . "</td></tr>"; //tulostetaan rivin kentät selaimelle
                "</table>";
            }

                }
    }
    ?> 
<?php
    function haeYhteystiedot(){
        include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
        if(($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_REQUEST['haeYhteystiedot']))){
            $kysely=$yhteys->prepare("SELECT etunimi, sukunimi, puhkoti, sahkoposti, katuosoite, postinumero, postitoimipaikka FROM henkilotiedot JOIN yhteystiedot ON henkilotiedot.osoiteID=yhteystiedot.osoiteID ORDER BY sukunimi");
            $kysely->execute();
            echo "<h4>Henkilöstön yhteystiedot sukunimen mukaan järjestettynä</h4>";
            echo "<table><tr><th>Etunimi</th> <th>Sukunimi</th><th>Puhelin kotiin </th> <th> Sähköposti </th> <th> Katuosoite </th> <th> Postinumero </th> <th> Postitoimipaikka</th>";
            while ($rivi = $kysely->fetch()) { // käydään kaikki tulosjoukon rivit läpi. $rivi on taulukon yksi rivi eli yhden henkilän tiedot
                echo "<tr><td>" . $rivi['etunimi'] ."</td><td>" . $rivi['sukunimi'] . "</td><td>"  . $rivi['puhkoti'] ."</td><td>" . $rivi['sahkoposti'] . "</td><td>"  . $rivi['katuosoite'] . "</td><td>". $rivi['postinumero'] . "</td><td>" . $rivi['postitoimipaikka'] . "</td></tr>"; //tulostetaan rivin kentät selaimelle
                "</table>";
    }
        }
    }
?>

<?php

    function haeMuistaminenMuutettavaksi(){
        include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysHenkilotiedot.php");
        if(($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_REQUEST['haeMuistamisTiedot']))){ // jos painetaan haeMuistaminen
            $sukunimi=($_POST["sukunimi"]);
            //prepare valmistelee sql kyselyn suorittamista varten
            $kysely = $yhteys->prepare("SELECT etunimi, sukunimi, kukka, lahja FROM henkilotiedot JOIN muistaminen ON henkilotiedot.henkiloID = muistaminen.henkiloID
            AND sukunimi=:sukunimi");  //haetaan tarvittavat tiedot
            $kysely->bindParam(":sukunimi", $sukunimi);
            $kysely->execute();//suorttaa kyselyn joka on valmisteltu prepare-funktiolla
            $rivi=$kysely->fetch();
    ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 

            <!-- value ilmoittaa mitkä ovat nyt kannassa olevat tiedot -->
        <input type="hidden" name="sukunimi" value="<?php echo $rivi['sukunimi'];?>">
        Etunimi: <input name="etunimi" value="<?php echo $rivi['etunimi'];?>">
        Kukka: <input name="kukka" value="<?php echo $rivi['kukka'];?>">
        Lahja: <input name="lahja" value="<?php echo $rivi['lahja'];?>"><br/>
        <input type="submit" name="tallennaUuudetMuistamistTiedot" value="Tallenna tiedot"/>
        </form>
<?php
    }
}
?>
