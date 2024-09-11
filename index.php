<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
require_once("connessione.php"); // file per le connessioni al database
use MieClassi\Utility as UT;
$FolderPath = "ImgLavori/";//percorso della cartella delle immagini dei lavori
    $sql = "SELECT lavori.idLavoro, lavori.ImagePath, lavori.descrizione, lavori.titolo FROM lavori";
    $query = $mysqli->query($sql);
    if ($query->num_rows> 0) {
        while ($righe = mysqli_fetch_array($query)) {
            $tmp = array(
                "idLavoro" => $righe["idLavoro"],
                "ImagePath" => $righe["ImagePath"],
                "descrizione" => $righe["descrizione"],
                "titolo"=> $righe["titolo"]
                
            );
            $dati[] = $tmp;
        }
    }

    $sql = "SELECT homepage.ImagePath, homepage.Titolo, homepage.Contenuto FROM homepage"; 
    $query = $mysqli->query($sql);
    if($query->num_rows > 0) {
        $righe = $query->fetch_array(MYSQLI_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manueldisabatino.it</title>
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/index.min.css" type="text/css">      
</head>
<body>
<?php 
    require("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR
?>
        <div class="contentspace">  <!--############ INIZIO DEL PRIMO CONTENUTO DELLLA PAGINA #################################-->
            <div class="grid"> <!-- ### INIZIO GRIGLIA ######## -->
                <div class="title">
                    <h2><?php echo $righe["Titolo"] ?></h2> 
                </div>
                <div class="paragrafo">
                    <p> <?php  echo $righe["Contenuto"];?></p>
                </div>
                <div class="img">
                    <img src="<?php echo "IMG/".$righe["ImagePath"] ?>" alt="sfondo" width="1024" height="600">
                </div>
            </div><!-- ###  FINE GRIGLIA  ########-->
        </div><!--  ############# FINE DEL PRIMO CONTENUTO  #############################-->
    <h2 id="title2">ESEMPIO DI LAVORI SVOLTI</h2>
        <div class="secondo-contenitore"><!--  #### INIZIO CONTENUTO SECONDARIO  ###############-->
        <?php
            echo UT::crea3Card($FolderPath, $dati);
        ?>
            </div>  <!--  #### FINE CONTENUTO SECONDARIO  ###############-->
    <?php 
        require("footer.php");  //### FOOTER DELLA PAGINA
    ?>
</body>
</html>