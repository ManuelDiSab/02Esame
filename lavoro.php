<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
use MieClassi\Utility as UT;
$file = "dati.json"; //file json da cui prendere i dati 
$str_json = json_decode(UT::leggiTesto($file));  
$selezionato= UT::richiestaHTTP("selezionato");
$selezionato= ($selezionato == null) ? 1 : $selezionato;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $str_json->lavoro->title; ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $str_json->favicon;?>">
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/lavoro.min.css" type="text/css">   
</head>
<body>
<?php 
    require("nav_bar.php");
?>  

    <?php 
    foreach($str_json->lavoro->contenuto as $arr){
    $n = $arr->id;
    $classeSelezionato = ($n == $selezionato ) ? 'class="selezionato"' : "";
    if($selezionato == $n )
    printf(
         "<h1 %s>%s</h1>
        <div class='main'>
            <div class='lavoro'>
                <img src='IMG/web-developer.jpeg' alt='web developer'>
                <br>
                <div class='colonna'>
                    <br>
                    <p>%s</p>
                    <a href=" .$str_json->chi_sono->url .">Dà un'occhiata anche agli altri lavori</a>
                </div>
            </div>
        </div>", $classeSelezionato, $arr->titolo, $arr->paragrafo);
    }

require("footer.php");
?>
</body>
</html>