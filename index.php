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
    <title><?php echo $str_json->index->title;?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $str_json->favicon;?>">
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
                    <h2>PAGINA INIZIALE</h2> 
                </div>
                <div class="paragrafo">
                    <p> <?php  echo $str_json->index->paragrafo;?></p>
                </div>
                <div class="img">
                    <img src="<?php echo $str_json->index->img;?>" alt="sfondo" width="1024" height="600">
                </div>
            </div><!-- ###  FINE GRIGLIA  ########-->
        </div><!--  ############# FINE DEL PRIMO CONTENUTO  #############################-->
        <h2></h2>
    <h2 id="title2">ESEMPIO DI LAVORI SVOLTI</h2>
        <div class="secondo-contenitore"><!--  #### INIZIO CONTENUTO SECONDARIO  ###############-->
<!--########## CREAZIONE COL CICLO FOR DI 3 CARD CONTENENTI DELLE SIMULAZIONI DI LAVORI  #################-->
         <?php
                for($i=0; $i<=2; $i++)
                {
                    echo
            '<div class="card">
                    <a href="lavoro.php" title=" Vai al lavoro_n°x">Questo è il lavoro che ho fatto per ... e riguardava ...
                    <div class="img"><img src="IMG/webdev.jpg" alt=""></div></a>
                </div>';
                }
                    ?>
            </div>  <!--  #### FINE CONTENUTO SECONDARIO  ###############-->
    <?php 
        require("footer.php");  //### FOOTER DELLA PAGINA
    ?>
</body>
</html>