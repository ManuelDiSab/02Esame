<?php
require_once("connessione.php");
require_once("utility.php");

use MieClassi\Utility as UT;

$selezionato = UT::richiestaHTTP("idServizio");
$selezionato = ($selezionato == null) ? 1 : $selezionato;
$sql = "SELECT * FROM servizi;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLA PAGINA SERVIZI
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
    while ($righe = mysqli_fetch_array($query)){
        $tmp = array(
            "idServizio" => $righe["idServizio"],
            "Titolo" => $righe["Titolo"],
            "Servizio" => $righe["Servizio"]
            
        );
        $dati[] = $tmp;
    }   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Servizio</title>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/contact.min.css">
    <link rel="stylesheet" href="css/backend.min.css">
    <script></script>
</head>

<body>
    <?php require_once("nav_bar.php"); ?>

    <main>
        <?php foreach ($dati as $arr) {
            $n = $arr["idServizio"];
            $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : ""; //in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
            if ($selezionato == $n) {
                echo '<div class="container">
            <form action="backend.php?idServizio='.$arr["idServizio"] .'" method="POST" novalidate>
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
            <label for="titolo" id="lb_titolo">Titolo</label>
            <input type="text" name="Titolo" id="titolo"  maxlength="15" value="' . $arr["Titolo"] . '">
            <input type="hidden" name="check" value="">
        </div>
        <div class="inputbox">
                <label for="Servizio" id="lb_Servizio"> Servizio </label>
                <textarea type="text"  name="Servizio" id="Servizio"  maxlength="500" >' . $arr["Servizio"] . '</textarea>
        </div>
        <div class="button-container">
        <button type="submit" name="modificaServizi" id="modificaServizi">MODIFICA</button>
    </div>
    </form></div>';
            }
        } ?>
    </main>



    <?php require_once("footer.php") ?>
</body>

</html>