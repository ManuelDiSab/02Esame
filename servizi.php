<?php 
 require_once("utility.php"); // file contenente alcune funzioni utili
 require_once("connessione.php"); // File con le connessioni alla base dati
 use MieClassi\Utility as UT;
    $sql = "SELECT servizi.Titolo, servizi.Servizio FROM servizi";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while($righe = $query->fetch_array(MYSQLI_ASSOC)){
            $tmp = array(
                "Servizio" => $righe["Servizio"],
                "Titolo"=> $righe["Titolo"]
            );
            $dati[] = $tmp;
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servizi</title>
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/servizi.min.css" type="text/css">   
</head>
<body>
<?php 
    require_once("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR
?>            
<div class="contenuto"><!-- #######  INIZIO DEL CONTENUTO DELLA PAGINA ####################-->
    <div class="colonna1"><!-- ####### COLONNA DI SINISTRA ####################-->
        <img src="IMG/laptop.png" alt="laptop computer">
    </div>
    <div class="colonna2"><!-- ####### COLONNA DI DESTRA ####################-->
        <h1>Servizi Offerti</h1>
        <ul>
        <?php 
            echo UT::Creaservizio($dati);    
        ?>
        </ul>
        <button>SCARICA IL  PDF</button><!-- ### IPOTETICO BUTTON PER SCARICARE UN PDF CHE AL MOMENTO NON ESISTE###################-->
    </div>
    </div>
<?php 
    require("footer.php");  //### FOOTER DELLA PAGINA ###################
?>
</body>
</html>