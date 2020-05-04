# henkkis
Php-tietokantaharjoitus
# Henkkis henkilöstöohjelma

SQL-tietokanta on tehty SQL-kurssilla yhdessä opiskelukaverin kanssa. PHP-kurssin jälkeen halusin hyödyntää sitä käyttöliittymäntekoa harjoitellessa. Jouduin jonkin verran muokkaamaan tietokantaa, esimerkiksi poistamaan not null-vaatimuksia. Lisäksi MariaDb vaati hieman erilaisen "daten" kuin MySql. 

Sivuston pääpaino on php:n avulla tietokannan käsittely, sen vuoksi en ole sivuston ulkoasun kanssa juurikaan kikkaillut. Tämä on toinen php-tietokantaharjoitukseni ja ajatuksena oli kokeilla erilaisia hakuja. Tarkoituksena on jatkaa erilaisten muokkaus- ja hakutoimintojen tekoa myöhemmin. 

## Toiminnot
- Pääkäyttäjä luo uuden työntekijän tunnuksen (käytetty salasan tiivistämistä $salt, $crypt)
- Käyttäjä kirjautuu ohjelmaan
- Käyttäjä voi hakea tietoa_
    - työntekijöiden muistamisista
    - työntekijöiden yhteystiedot
    - työntekijöiden syntymäpäivät
- käyttäjä voi lisätä uuden työntekijän
- käyttäjä voi muokata työntekijän muistamisia

## Tietokannat
Sivustossa on kaksi tietokantaa. Tunnukset.sql on yhden taulun tietokanta, henkilotiedot.sql on 5 taulun tietokanta. 

##  Tiedostorakenne
- tietokannat
    - henkilotiedot.sql= henkilötietojen tietokanta
    - tunnukset.sql=käyttäjätunnustuen tietokanta
- sivustot
    - etusivu.php = aloitussivu
    - rekisteroidy.php = rekisteröitymissivu
    - hakusivu.php = haku- ja lisäytoiminnot
- tietokantayhteydet
    - tietokantayhteysHenkilotiedot.php
    - tietokantayhteysKirjautuminen.php
- funktiot
    - lisaysfunktiot.php = Datan lisäämiseen liittyvien funktioiden koodit
    - hakufunktiot.php= Datan hakuun liittyvien funktioiden koodit
- resurssit
    - tyylit.css
    - logo.jpg
