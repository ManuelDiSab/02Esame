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
    <title>  <?php echo $str_json->chi_sono->title;    ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $str_json->favicon;?>">  <!--## FAVICON DEL SITO ##########-->
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
            <h2 id="h2"><?php echo $str_json->chi_sono->titolo1; ?> </h2>
            <p><?php echo $str_json->chi_sono->paragrafo; ?></p>
        </div>
        <div class="img">
            <img src="<?php echo $str_json->chi_sono->img1; ?>" alt="web developer" id="img1" height="450px" width="600px">
        </div>
    </div>

    <div class="container2"><!--### SECONDA PARTE ########################-->
         <img src="<?php echo $str_json->chi_sono->img2; ?>" alt="codice html" id="img2" height="600px" width="850px">
        <div class="content2">
            <h2><?php echo $str_json->chi_sono->titolo2; ?> </h2>
            <p><?php echo $str_json->chi_sono->paragrafo; ?></p>
        </div>
        
    

</div>
<h1>I MIEI LAVORI</h1>
        
        <div class="lavori"><!-- #####   INIZIO DEL CONTENUTI DEI LAVORI   #############################-->

<!--########## CREAZIONE COL CICLO FOR DI 6 CARD CONTENENTI DELLE SIMULAZIONI DI LAVORI  #################--> 
        <?php
        for($i=0; $i<=5; $i++){  echo 
           '<div class="card">
                   <a href="lavoro.php" title="Vai al lavoro_n°x">Questo è il lavoro che ho fatto per ... e riguardava ...
                   <div class="img"><img src="IMG/webdev.jpg" alt=""></div></a>
               </div>';
            }
            ?>

               
           </div><!-- #####   FINE DEL CONTENUTI DEI LAVORI   ########################-->
</div>
<?php 

    require("footer.php");  //### FOOTER DELLA PAGINA

?>


</body>
</html>