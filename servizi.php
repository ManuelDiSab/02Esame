<?php 
 require_once("utility.php"); // file contenente alcune funzioni utili
 use MieClassi\Utility as UT;
$file = "dati.json"; //file json da cui prendere i dati 
$str_json = json_decode(UT::leggiTesto($file));  
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $str_json->servizi->title;?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $str_json->favicon;?>">
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/servizi.min.css" type="text/css">   
</head>
<body>
<?php 
    require_once("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR
?>            
<div class="contenuto"><!-- #######  INIZIO DEL CONTENUTO DELLA PAGINA ####################-->
    <div class="colonna1"><!-- ####### COLONNA DI SINISTRA ####################-->
        <img src="<?php echo $str_json->servizi->img;?>" alt="laptop computer">
    </div>
    <div class="colonna2"><!-- ####### COLONNA DI DESTRA ####################-->
        <h1><?php echo $str_json->servizi->titolo;?></h1>
        <ul>
        <?php 
        for($i=0;$i<2;$i++)// CREO CON IL CICLO FOR 2 ELEMENTI DI UNA LISTA
        echo "<li> <h3>Servizio</h3>" . "<br>" . $str_json->servizi->paragrafo ."</li>"; ?>
        </ul>
        <button>SCARICA IL  PDF</button><!-- ### IPOTETICO BUTTON PER SCARICARE UN PDF CHE AL MOMENTO NON ESISTE###################-->
    </div>
    </div>
<?php 
    require("footer.php");  //### FOOTER DELLA PAGINA ###################
?>
</body>
</html>