<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
require_once("connessione.php"); // file per le connessioni al database
use MieClassi\Utility as UT;
$FolderPath = "ImgLavori/";
try{
    $sql = "SELECT lavori.idLavoro, lavori.ImagePath, lavori.descrizione, lavori.titolo FROM lavori";
    $query = $pdo->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $lunghezza = 0;
        while ($righe = $query->fetch(PDO::FETCH_ASSOC)) {
            $tmp = array(
                "idLavoro" => $righe["idLavoro"],
                "ImagePath" => $righe["ImagePath"],
                "descrizione" => $righe["descrizione"],
                "titolo"=> $righe["titolo"]
            );$lunghezza++;
            $dati[] = $tmp;
        }   
    }
}
catch(PDOException $e) {
    echo "errore PDO:" . $e->getMessage();
    die();
}
try{
    $sql2 = "SELECT chi_sono.Titolo, chi_sono.Contenuto, chi_sono.ImagePath, chi_sono.Titolo2, chi_sono.Contenuto2, chi_sono.ImagePath2  FROM chi_sono";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    if ($query2->rowCount() > 0) {
        $righe2 = $query2->fetch(PDO::FETCH_ASSOC);
        }   
    }
catch(PDOException $e) {
    echo "errore PDO:" . $e->getMessage();
    die();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHI SONO</title>
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">  <!--## FAVICON DEL SITO ##########-->
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/chi_sono.min.css" type="text/css">      
</head>
<body>
<?php 
    require("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR
?>
<div class="main"><!--### CONTENUTO DELLA PAGINA ########################-->
    <div class="container1"><!--### PRIMA PARTE ########################-->
        <div class="content">
            <h2 id="h2"><?php echo $righe2["Titolo"]?> </h2>
            <p><?php echo $righe2["Contenuto"]?></p>
        </div>
        <div class="img">
            <img src="<?php echo "IMG/".$righe2["ImagePath"] ?>" alt="web developer" id="img1" height="450" width="600">
        </div>
    </div>

    <div class="container2"><!--### SECONDA PARTE ########################-->
         <img src="<?php echo "IMG/".$righe2["ImagePath2"] ?>" alt="codice html" id="img2" height="600" width="850">
        <div class="content2">
            <h2><?php echo $righe2["Titolo2"] ?> </h2>
            <p><?php echo $righe2["Contenuto2"] ?></p>
        </div>
</div>
<h1>I MIEI LAVORI</h1>
        
        <div class="lavori"><!-- #####   INIZIO DEL CONTENUTI DEI LAVORI   #############################-->

<!--########## CREAZIONE COL CICLO FOR DI 6 CARD CONTENENTI DELLE SIMULAZIONI DI LAVORI  #################--> 
        <?php
            echo UT::creaCard($FolderPath, $dati);
        ?> 
           </div><!-- #####   FINE DEL CONTENUTI DEI LAVORI   ########################-->
</div>
<?php 
    require("footer.php");  //### FOOTER DELLA PAGINA
?>
</body>
</html>