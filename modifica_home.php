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
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">  <!--## FAVICON DEL SITO ##########-->
    <title>Modifiche</title>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/contact.min.css">
    <link rel="stylesheet" href="css/backend.min.css">
</head>

<body>
    <?php require_once("nav_bar.php"); ?>

    <main>
        <?php foreach ($dati as $arr) {
            $n = $arr["idHome"];
            $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : ""; //in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
            if ($selezionato == $n) {
                echo '<div class="container">
            <form action="backend.php?idHome='.$arr["idHome"] .'" method="POST" novalidate onSubmit="return verifyform(this)">
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
            <label for="titolo" id="lb_titolo">Titolo</label>
            <input type="text" name="Titolo" id="titolo"  maxlength="15" value="' . $arr["Titolo"] . '" onChange="return verify(this,'."Titolo".')">
            <input type="hidden" name="check" value="">
        </div>
        <div class="inputbox">
                <label for="Contenuto" id="lb_Contenuto"> Contenuto </label>
                <textarea name="Contenuto" id="Contenuto"  maxlength="500" onChange="return verify(this,'."Contenuto".')">' . $arr["Contenuto"] . '</textarea>
        </div>
        <div class="button-container">
        <button type="submit" name="modificaHome" id="modificaHome">MODIFICA</button>
    </div>
    </div></form></div>';
            }
        } ?>
    </main>
    <script>
	function verify(f,nomecampo)
	{//Validazione dati
		if (f.value=='') {
			alert('Devi immettere un valore per il campo '+nomecampo);
			return false;
		} else
			return true;
	}
	
	function verifyform(f)
	{  
	    return verify(f.Contenuto,'Contenuto') && verify(f.Titolo,'Titolo');

	}
    </script>


    <?php require_once("footer.php") ?>
</body>

</html>