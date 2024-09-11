<?php
    require_once("connessione.php");
    require_once("utility.php");
    use MieClassi\Utility as UT;
    $selezionato= UT::richiestaHTTP("idUtente");
    $selezionato= ($selezionato == null) ? 1 : $selezionato;
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
    <script src="utility.js"></script>
    </head>
<body>
    <?php require_once("nav_bar.php"); 
            $sql = "SELECT * FROM utenti;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLA HOMEPAGE
            $query = $mysqli->query($sql);
            if ($query->num_rows > 0) {
                while ($righe = mysqli_fetch_array($query)) {
                    $tmp = array(
                        "idUtente" => $righe["idUtente"],
                        "nome" => $righe["nome"],
                        "cognome" => $righe["cognome"],
                        "email" => $righe["email"],
                        "telefono" => $righe["telefono"],
                        "richiesta" => $righe["richiesta"]
                    );
                    $dati[] = $tmp;
                }   
            }
    ?>
    <main>
    <?php 
    foreach($dati as $arr){
        $n = $arr["idUtente"];
        $classeSelezionato = ($n == $selezionato ) ? 'class="selezionato"' : "";//in base all'id che corrisponde a $selezionato creo il contenuto della pagina 
        if($selezionato == $n ){
        echo '<div class="container">
            <form action="backend.php?idUtente='.$arr["idUtente"] .'" method="POST" novalidate onSubmit="return verifyform(this)">
                <h2>MODIFICA </h2>
                <div class="content">
                <div class="inputbox">
                        <label for="nome" id="lb_nome">Nome</label>
                        <input type="text" name="nome" id="nome"  maxlength="15" value="' . $arr["nome"] . '" onChange="return verify(this,'."nome" .')">
                    </div>
                    <div class="inputbox">
                            <label for="cognome" id="lb_cognome"> Cognome </label>
                            <input type="text"  name="cognome" id="cognome"  maxlength="15" value="' . $arr["cognome"] . '" onChange="return verify(this,'."cognome" .')">
                    </div>
                    <div class="inputbox">
                        <label for="email" id="lb_email">Email</label>
                        <input type="email" name="email" id="email"  maxlength="30" value="' . $arr["email"] . '" onChange="return verify(this,'."email".')">
                    </div>
                    <div class="inputbox">
                        <label for="telefono" id="lb_telefono">Telefono</label>
                        <input type="tel" name="telefono" id="telefono"  maxlength="15" value="' . $arr["telefono"] . '" onChange="return verify(this,'."telefono" .')">
                    </div>
                    <label for="richiesta" id="lb_richiesta">Richiesta</label>
                    <textarea name="richiesta" id="richiesta" placeholder="Dimmi qualcosa su di te" required onChange="return verify(this,'."richiesta" .')">'.$arr["richiesta"] .'</textarea>
                    <div class="button-container">
                        <button type="submit" name="modifica" id="modifica">MODIFICA</button>
                    </div></div>
                    </form></div>';
        }
    }
    
     ?>
    <script>
    let fu = new Funzioni();
    //Validazione dati
    const email = document.getElementById("email").value;
    if(!fu.validaMail(email)){
        alert("Mail errata");
    }
	function verify(f,nomecampo)
	{
		if (f.value=='') {
			alert('Devi immettere un valore per il campo '+nomecampo);
			return false;
		} else
			return true;
	}
	
	function verifyform(f)
	{  
	    return verify(f.nome,'nome') && verify(f.cognome,'cognome')  && verify(f.email,'email')  && verify(f.richiesta,'richiesta')  && verify(f.telefono,'telefono');
	}

    </script>
    </main>
<?php require_once("footer.php") ?>
</body>
</html>