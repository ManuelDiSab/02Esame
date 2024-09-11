<?php
require_once("connessione.php");
require_once("utility.php");

use MieClassi\Utility as UT;

$selezionato = UT::richiestaHTTP("IdLavoro");
$selezionato = ($selezionato == null) ? 1 : $selezionato;
$sql3 = "SELECT * FROM lavori;"; //CODICE PER LA VISUALIZZAZIONE DEI DATI DELLE CARD DEI PROGETTI
$query3 = $mysqli->query($sql3);
if ($query3->num_rows > 0) {
    while ($righe = mysqli_fetch_array($query3)) {
        $tmp = array(
            "IdLavoro" => $righe["IdLavoro"],
            "ImagePath" => $righe["ImagePath"],
            "titolo" => $righe["titolo"],
            "descrizione" => $righe["descrizione"]

        );
        $dati3[] = $tmp;
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
        <?php foreach ($dati3 as $arr) {
            $n = $arr["IdLavoro"];
            $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : ""; //in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
            if ($selezionato == $n) {
                echo '<div class="container">
            <form action="backend.php?IdLavoro='.$arr["IdLavoro"] .'" method="POST" novalidate>
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
            <label for="titolo" id="lb_titolo">Titolo</label>
            <input type="text" name="titolo" id="titolo"  maxlength="15" value="' . $arr["titolo"] . '">
            <input type="hidden" name="check" value="">
        </div>
        <div class="inputbox">
                <label for="descrizione" id="lb_descrizione"> Contenuto </label>
                <textarea type="text"  name="descrizione" id="descrizione"  maxlength="500" >' . $arr["descrizione"] . '</textarea>
        </div>
        <div class="button-container">
        <button type="submit" name="modificaLavoro" id="modificaLavoro">MODIFICA</button>
    </div>
    </form></div>';
            }
        } ?>
    </main>



    <?php require_once("footer.php") ?>
</body>

</html>