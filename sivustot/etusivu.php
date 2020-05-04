<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel= "stylesheet" type="text/css" href="/henkkis/resurssit/tyylit.css">
    <title>Etusivu</title>
</head>
<body>
<div>
<!-- <img src="resurssit/logo.jpg" alt="logo">  -->
 </div>
 <div class="tausta">

<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <!-- <h3>Column 1</h3> -->
    </div>
  
    <div class="col-sm-6">
      <img src="/henkkis/resurssit/logo.jpg" alt="logo"> 
   
      <h4> Henkkis henkilöstöhallinnon yhteyshenkilöt yrityksessänne ovat: <h4>
        <p>Pääkäyttäjä: Ville Velho 040-1257822</p>
        <p>Tekninen tuki: 0500-75214</p>
    </div>

    <div class="col-sm-3">
      <h3>Kirjaudu</h3>
      <table>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
       Tunnus <br>    <input type="text" name="tunnus" require> <br>
       Salasana <br> <input type="passwd" name="salasana" require> <br>
       <br>
        <input type="submit" name="laheta" value="Kirjaudu">
      </table>   
      <br>
      <br>
      <p><b><a href="rekisteroidy.php" target="_blank">Rekisteröidy palveluun täällä.</a></b></p>    
    </div>
  </div>
</div>
</div>
<?php
include("/xampp/htdocs/henkkis/tietokantayhteydet/tietokantayhteysKirjautuminen.php"); 

//lomakkeen validointi:
$tunnus=$salasana="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tunnus = test_input($_POST["tunnus"]);
    $sala = test_input($_POST["salasana"]);
    //kryptaus
    $salt="k1su4vGetRpw6nit59thq";
    $salasana=crypt($sala,$salt);
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<?php
// 
 if(isset($_REQUEST['tunnus'])){
$kysely = $yhteys->prepare ("SELECT * FROM salakoodit WHERE tunnus=:tunnus AND salasana=:salasana");
    $kysely ->bindParam(":tunnus", $tunnus);
    $kysely ->bindParam(":salasana", $salasana);
    $kysely->execute();
    $rivi=$kysely->fetch();
 }


if(isset($_REQUEST['laheta'])&& (!(empty($rivi['id'])))){
     $_SESSION['sessio']=$_REQUEST['tunnus'];
    header("location:hakusivu.php");

   }


?>

</body>
</html>