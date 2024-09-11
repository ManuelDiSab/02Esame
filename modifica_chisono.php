<?php
require_once("connessione.php");
require_once("utility.php");

use MieClassi\Utility as UT;

$selezionato = UT::richiestaHTTP("idChiSono");
$selezionato = ($selezionato == null) ? 1 : $selezionato;
$sql2 = "SELECT * FROM chi_sono;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLA PAGINA CHI SONO
$query2 = $mysqli->query($sql2);
if ($query2->num_rows > 0) {
    while ($righe = mysqli_fetch_array($query2)) {
        $tmp = array(
            "idChiSono" => $righe["idChiSono"],
            "ImagePath" => $righe["ImagePath"],
            "Titolo" => $righe["Titolo"],
            "Contenuto" => $righe["Contenuto"],
            "ImagePath2" => $righe["ImagePath2"],
            "Titolo2" => $righe["Titolo2"],
            "Contenuto2" => $righe["Contenuto2"]
        );
        $dati2[] = $tmp;
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
        <?php foreach ($dati2 as $arr) {
            $n = $arr["idChiSono"];
            $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : ""; //in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
            if ($selezionato == $n) {
                echo '<div class="container">
            <form action="backend.php?idChiSono='.$arr["idChiSono"] .'" method="POST" novalidate onSubmit="return verifyform(this)">
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
            <label for="titolo" >Titolo</label>
            <input onChange="return verify(this,'."Titolo".')" type="text" name="Titolo" id="titolo"  maxlength="25" value="' . $arr["Titolo"] . '">
            <input type="hidden" name="check" value="">
        </div>
        <div class="inputbox">
                <label for="Contenuto" > Contenuto </label>
                <textarea onChange="return verify(this,'."Contenuto".')" name="Contenuto" id="Contenuto"  maxlength="500" >' . $arr["Contenuto"] . '</textarea>
        </div>
                        <div class="inputbox">
            <label for="titolo" >Titolo</label>
            <input type="text" name="Titolo2" id="titolo2"  maxlength="25" value="' . $arr["Titolo2"] . '" onChange="return verify(this,'."Titolo2".')">
        </div>
        <div class="inputbox">
                <label for="Contenuto" > Contenuto </label>
                <textarea onChange="return verify(this,'."Contenuto2".')" name="Contenuto2" id="Contenuto2"  maxlength="500" >' . $arr["Contenuto2"] . '</textarea>
        </div>
        <div class="button-container">
        <button type="submit" name="modificaChiSono" id="modificaChiSono">MODIFICA</button>
    </div></div>
    </form></div>';
            }
        } ?>
    </main>
    <script>
	function verify(f,nomecampo)
	{
		if (f.value=='') {//Validazione dati
			alert('Devi immettere un valore per il campo '+nomecampo);
			return false;
		} else
			return true;
	}
	
	function verifyform(f)
	{  
	    return verify(f.Contenuto,'Contenuto') && verify(f.Titolo,'Titolo') && verify(f.Contenuto2,'Contenuto2') && verify(f.Titolo2,'Titolo2') ;
	}
    </script>

    <?php require_once("footer.php") ?>
</body>

</html>