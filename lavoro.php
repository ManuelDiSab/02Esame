<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
require_once("connessione.php"); // file per le connessioni al database
use MieClassi\Utility as UT;
$selezionato= UT::richiestaHTTP("selezionato");
$selezionato= ($selezionato == null) ? 1 : $selezionato;
    $sql = "SELECT lavori.idLavoro, lavori.ImagePath, lavori.descrizione, lavori.titolo FROM lavori";//estraggo gli elementi dal db
    $query = $mysqli->query($sql);
    if ($query->num_rows> 0) {
        while ($righe = $query->fetch_array(MYSQLI_ASSOC)) {
            $tmp = array(//creo un'array temporaneo
                "idLavoro" => $righe["idLavoro"],
                "ImagePath" => $righe["ImagePath"],
                "descrizione" => $righe["descrizione"],
                "titolo"=> $righe["titolo"]
            );
            $dati[] = $tmp;//creo l'array dati e ci inserisco l'array tempopraneo 
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
    foreach($dati as $arr){//Creo il titolo con un ciclo foreach per estrarre l'id dall'array
        if($selezionato == $arr["idLavoro"]){
            echo "Lavoro n°".$arr["idLavoro"];}
        }?></title>
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/lavoro.min.css" type="text/css">   
</head>
<body>
<?php 
    require("nav_bar.php");
?>  

    <?php 
    foreach($dati as $arr){//Creo il contenuto con un ciclo foreach per estrarre i dati dall'array
    $n = $arr["idLavoro"];
    $classeSelezionato = ($n == $selezionato ) ? 'class="selezionato"' : "";//in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
    if($selezionato == $n )
    printf(
         "<h1 %s>%s</h1>
        <div class='main'>
            <div class='lavoro'>
                <img src='ImgLavori/".$arr["ImagePath"]."' alt='web developer' width='600' height='450'>
                <br>
                <div class='colonna'>
                    <br>
                    <p>%s</p>
                    <a href='chi_sono.php'>Dà un'occhiata anche agli altri lavori</a>
                </div>
            </div>
        </div>", $classeSelezionato, $arr["titolo"], $arr["descrizione"]);
    }

require("footer.php");
?>
</body>
</html>