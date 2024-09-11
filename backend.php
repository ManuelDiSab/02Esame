<?php
session_start();
if(!isset($_SESSION['login'])){ //Controllo per entrare nel backend solo tramite login
    header("Lcation: index.php");
    exit();
}
    require_once("utility.php");// funzioni utili 
    require_once("connessione.php"); // connessione al DB
    use MieClassi\Utility as UT;

    //Cdice per l'aggiunta dei progetti nel DataBase
    if(isset($_POST["submit"])){//controllo se è stato fatto il submit e se si eseguo il codice sottostante
        $descrizione = $_POST["descrizione"];
        $titolo = $_POST["titolo"];
        if ($_FILES["img"]["error"] === 4) {//verifico l'inserimento dell'immagine
            echo  `<script> alert("L'immagine non esiste")</script>`;
        }
        else{
        $estensioni_permesse = ["jpg", "png", "jpeg"];
        $file_name = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];            
        $imageExtension = explode('.', $file_name);
        $imageExtension = strtolower(end($imageExtension));
        $newImageName = uniqid();//creo un nome unico per l'immagiine
        $newImageName .= '.' . $imageExtension;
    
    move_uploaded_file($tmp_name, "ImgLavori/" . $newImageName);//inserisco l'immagine nella cartella ImgLavori
    
    $sql = "INSERT INTO lavori(ImagePath,descrizione,titolo) VALUES(?,?,?)";
    $query = $mysqli->prepare($sql); 
    $query->bind_param("sss", $newImageName, $descrizione, $titolo);
    $query->execute();
    echo  `<script> alert("Lavoro inserito con successo")</script>`;
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/backend.min.css">
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">  <!--## FAVICON DEL SITO ##########-->
    <title>Pannello di Gestione</title>
</head>
<header>
        <div class="navbar"><!-- ####### INIZIO DEL MENU DI NAVIGAZIONE ############################################-->
            <input type="checkbox" id="controllo">
            <label for="controllo" class="label-controllo">
                <span></span>
            </label>
            <a class="logo" href="index.php"><img src="IMG/logo3.png"  alt="logo" title="logo"></a>
            <ul class="menu">
                    <li><a href="index.php" target="_self">HOME PAGE</a></li>
                    <li><a href="chi_sono.php" target="_self">CHI SONO</a></li>
                    <li><a href="servizi.php" target="_self">SERVIZI OFFERTI</a></li>
                    <li><a href="logout.php" target="_self">LOGOUT</a></li>
                    <li><a id="button" href="contact.php" target="_self" style="text-decoration: none;  " title="contact">CONTACT</a></li>
                </ul>               
        </div><!--############## FINE DEL MENU DI NAVIGAZIONE ############################-->
    </header>
<body>
    <main>
    <div class="form-content">
            <form action="" class="categoria">
                <label for="scelta">Scegli il contenuto da visualizzare</label>
                <select onchange="showTable(this)" id="scelta"><!-- ###     SELECT PER LA SCELTA DELLE SINGOLE TABELLE CON FUNZIONE PER LA VISUALIZZAZIONE DELLA TABELLA SCELTA -->
                    <option  value="Tutti" selected>Mostra tutto</option>
                    <option  value="Home">Home Page </option>
                    <option  value="Chi_sono">Chi Sono</option>
                    <option  value="Servizio">Servizi Offerti</option>
                    <option  value="Card_lavori">Card Lavori</option>
                    <option  value="Utenti">Utenti</option>
                </select>
                </option>
            </form>
        </div>
<?php
    //########## SQL PER LA HOMEPAGE  ################################
    if(isset($_POST["modificaHome"])){
        $Titolo = $_POST["Titolo"];
        $Contenuto = $_POST["Contenuto"];
        if(isset($_GET["idHome"])){
        $id = $_GET["idHome"];
        if(UT::CtrlLenght($Titolo,5,15) && UT::CtrlLenght($Contenuto,10,500)){//Valido i dati da immettere nel db
        $update = mysqli_query($mysqli,"UPDATE homepage SET Titolo='$Titolo',Contenuto='$Contenuto' WHERE idHome=$id");
        }
        else{
            header("Location:modifica_home.php?idHome=$id");
        }
    }
    }
    elseif(isset($_GET["idHome"])){
        $id = $_GET["idHome"];
        $delete = mysqli_query($mysqli, "DELETE FROM homepage WHERE idHome='$id'");
    }
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
    //####################    FINE  SQL HOMEPAGE   ####################################################


    //########## SQL PER LA PAGINA CHI SONO  ################################
    if(isset($_POST["modificaChiSono"])){
        $Titolo = $_POST["Titolo"];
        $Titolo2 = $_POST["Titolo2"];
        $Contenuto = $_POST["Contenuto"];
        $Contenuto2 = $_POST["Contenuto2"];
        if(isset($_GET["idChiSono"])){
        $id = $_GET["idChiSono"];
        if(UT::CtrlLenght($Titolo,5,15) && UT::CtrlLenght($Contenuto,10,500) && UT::CtrlLenght($Titolo2,5,15) && UT::CtrlLenght($Contenuto2,10,500)){
        $update = mysqli_query($mysqli,"UPDATE chi_sono SET Titolo='$Titolo',Titolo2='$Titolo2',Contenuto2='$Contenuto2',Contenuto='$Contenuto' WHERE idChiSono=$id");
        }else{
            header("Location:modifica_chisono.php?idHome=$id");
        }
    }
    }
    elseif(isset($_GET["idChiSono"])){
        $id = $_GET["idChiSono"];
        $delete = mysqli_query($mysqli, "DELETE FROM chi_sono WHERE idUtente='$id'");
    }
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
    //####################  FINE  SQL PER LA PAGINA CHI SONO    ####################################################




    //########## SQL PER I PROGETTI  ################################
    if(isset($_POST["modificaLavoro"])){
        $titolo = $_POST["titolo"];
        $descrizione = $_POST["descrizione"];
        if(isset($_GET["IdLavoro"])){
        $id = $_GET["IdLavoro"];
        if(UT::CtrlLenght($titolo,5,15) && UT::CtrlLenght($descrizione,10,500)){//Valido i dati da immettere nel db
        $update = mysqli_query($mysqli,"UPDATE lavori SET titolo='$titolo', descrizione='$descrizione' WHERE IdLavoro=$id");
        }else{
            header("Location:modifica_progetto.php?IdLavoro=$id");
        }       
        }
    }elseif(isset($_GET["IdLavoro"])){
        $id = $_GET["IdLavoro"];
        $delete = mysqli_query($mysqli, "DELETE FROM lavori WHERE IdLavoro='$id'");
    }
    
    $sql3 = "SELECT * FROM lavori;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLE CARD DEI PROGETTI
    $query3 = $mysqli->query($sql3);
    if ($query3->num_rows > 0) {
        while ($righe = mysqli_fetch_array($query3)){
            $tmp = array(
                "IdLavoro" => $righe["IdLavoro"],
                "ImagePath" => $righe["ImagePath"],
                "titolo" => $righe["titolo"],
                "descrizione" => $righe["descrizione"]
                
            );
            $dati3[] = $tmp;
        }   
    }
    $reset =mysqli_query($mysqli, "ALTER TABLE lavori AUTO_INCREMENT=0");
    //####################à  FINE SQL PER LE CARD PROGETTI   ####################################################




    //########## SQL PER LA PAGINA SERVIZI  ################################
    if(isset($_POST["modificaServizi"])){
        $Titolo = $_POST["Titolo"];
        $Servizio = $_POST["Servizio"];
        if(isset($_GET["idServizio"])){
        $id = $_GET["idServizio"];
        if(UT::CtrlLenght($Titolo,5,15) && UT::CtrlLenght($Servizio,10,500)){
        $update = mysqli_query($mysqli,"UPDATE servizi SET Titolo='$Titolo', Servizio='$Servizio' WHERE idServizio='$id'");
        }else{
            header("Location:modifica_servizi.php?idServizio=$id");
        }
    }
    }
    elseif(isset($_GET["idServizio"])){
        $id = $_GET["idServizio"];
        $delete = mysqli_query($mysqli, "DELETE FROM utenti WHERE idServizio='$id'");
    }
    $sql4 = "SELECT * FROM servizi;";//CODICE PER LA VISUALIZZAZIONE DEI DATI DELLA PAGINA SERVIZI
    $query4 = $mysqli->query($sql4);
    if ($query4->num_rows > 0) {
        while ($righe = mysqli_fetch_array($query4)){
            $tmp = array(
                "idServizio" => $righe["idServizio"],
                "Titolo" => $righe["Titolo"],
                "Servizio" => $righe["Servizio"]
                
            );
            $dati4[] = $tmp;
        }   
    }
    //####################  FINE  SQL PER LA PAGINA DEI SERVIZI   ####################################################





    //########## SQL PER GLI UTENTI  ################################
    if(isset($_POST["modifica"])){
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $richiesta = $_POST["richiesta"];
        if(isset($_GET["idUtente"])){
        $id = $_GET["idUtente"];
        if(UT::CtrlLenght($nome,2,25) && UT::CtrlLenght($cognome,2,25) && UT::CtrlLenght($email,7,30) && UT::CtrlLenght($telefono,5,15) && UT::CtrlLenght($telefono,10,500)){
        $update = mysqli_query($mysqli,"UPDATE utenti SET nome='$nome',cognome='$cognome',telefono='$telefono',email='$email', richiesta='$richiesta' WHERE idUtente=$id");
    }
    else{
        header("Location:modificaUtenti.php?idServizio=$id");
    }
    }
    }
    elseif(isset($_GET["idUtente"])){
        $id = $_GET["idUtente"];
        $delete = mysqli_query($mysqli, "DELETE FROM utenti WHERE idUtente='$id'");
    }
    $sql5 = "SELECT * FROM utenti;";//CODICE PER LA VISUALIZZAZIONE DEGLI UTENTI
    $query5 = $mysqli->query($sql5);
    if ($query5->num_rows > 0) {
        while ($righe = mysqli_fetch_array($query5)) {
            $tmp = array(
                "idUtente" => $righe["idUtente"],
                "nome" => $righe["nome"],
                "cognome" => $righe["cognome"],
                "email" => $righe["email"],
                "telefono" => $righe["telefono"],
                "richiesta" => $righe["richiesta"]
            );
            $dati5[] = $tmp;
        }   
    }
    //########## FINE UTENTI #########################################################################################




    echo ("<div class='contenuto' id='Home'>" . UT::CreaTableHome($dati) . "</div>");
    echo ("<div class='contenuto' id='Chi_sono'>" . UT::CreaTableChiSono($dati2) . "</div>");  
    echo ("<div class='contenuto' id='Card_lavori'>" . UT::CreaTableCard($dati3) . "</div>"); 
    echo ("<div class='contenuto' id='Servizio'>" . UT::CreaTableServizio($dati4) . "</div>"); 
    echo ("<div class='contenuto' id='Utenti'>" . UT::CreaTableUtenti($dati5) . "</div>");
    ?>
        <script>
        function showTable(element){//   FUNZIONE PER MOSTRARE GLI ELEMENTI QUANDO VENGONO SELEZIONATI NELLA SELECT
            //showTable FUNZIONA SE LE VIENE PASSATO this 
            const tabella = document.querySelectorAll('.contenuto');// PRENDO TUTTI GLI ELEMENTI DELLA CLASSE tabella
            tabella.forEach(hide);
            function hide(element){//FUNZIONE CHE AGGIUNGE LA CLASSE NASCONDI(display:none)
            element.classList.add('nascondi');
            }
            if(element.value === "Tutti"){//SE MOSTRA TUTTO E' SELEZIONATO NELLA SELECT...
                tabella.forEach(show);
                function show(element){
                    element.classList.remove('nascondi');//... ALLORA RIMUOVO LA CLASSE NASCONDI
                }
            };

            if(element.value !== "Tutti"){//ALTRIMENTI...
                document.getElementById(element.value).classList.remove('nascondi');//RIMUOVO LA CLASSE NASCONDI NELL'ELEMENTO SELEZIONATO
            };
        }
    </script>
    </main>
    <?php require_once("footer.php");?>
</body>

</html>