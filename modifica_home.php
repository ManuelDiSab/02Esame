<?php
require_once("connessione.php");
require_once("utility.php");

use MieClassi\Utility as UT;

$selezionato = UT::richiestaHTTP("IdLavoro");
$selezionato = ($selezionato == null) ? 1 : $selezionato;
$sql = "SELECT * FROM homepage;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLA HOMEPAGE
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
    while ($righe = mysqli_fetch_array($query)) {
        $tmp = array(
            "idHome" => $righe["idHome"],
            "ImagePath" => $righe["ImagePath"],
            "Titolo" => $righe["Titolo"],
            "Contenuto" => $righe["Contenuto"]
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
    <title>Modifiche</title>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/contact.min.css">
    <link rel="stylesheet" href="css/backend.min.css">
    <script></script>
</head>

<body>
    <?php require_once("nav_bar.php"); ?>

    <main>
        <?php foreach ($dati as $arr) {
            $n = $arr["idHome"];
            $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : ""; //in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
            if ($selezionato == $n) {
                echo '<div class="container">
            <form action="backend.php?idHome='.$arr["idHome"] .'" method="POST" novalidate>
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
            <label for="titolo" id="lb_titolo">Titolo</label>
            <input type="text" name="Titolo" id="titolo"  maxlength="15" value="' . $arr["Titolo"] . '">
            <input type="hidden" name="check" value="">
        </div>
        <div class="inputbox">
                <label for="Contenuto" id="lb_Contenuto"> Contenuto </label>
                <textarea type="text"  name="Contenuto" id="Contenuto"  maxlength="500" >' . $arr["Contenuto"] . '</textarea>
        </div>
        <div class="button-container">
        <button type="submit" name="modificaHome" id="modificaHome">MODIFICA</button>
    </div>
    </form></div>';
            }
        } ?>
    </main>
        


    <?php require_once("footer.php") ?>
</body>

</html>