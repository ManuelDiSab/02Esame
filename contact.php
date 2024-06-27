<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
use MieClassi\Utility as UT;
$file = "dati.json"; //file json da cui prendere i dati 
$str_json = json_decode(UT::leggiTesto($file)); 
$inviato = UT::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato != 1 ) ? false:true; 
 if($inviato){
    $valido=0;
    //RECUPERO I DATI DAL FORM S
    $nome=UT::richiestaHTTP("nome");
    $cognome =UT::richiestaHTTP("cognome");
    $email=UT::richiestaHTTP("email");
    $telefono= UT::richiestaHTTP("telefono");
    $testo= UT::richiestaHTTP("testo");

    $clsErrore = 'class="errore" ';

  //FACCIO LA VALIDAZIONE DEI DATI RECUPERATI DAL FORM UTILIZZANDO LO STESSO METODO DEGLI ESERCIZI DI PHP
  if(($nome!= "" )  && (strlen("nome") <= 25))
  {
      $clsErroreNome="";
  }
  else
  {
      $valido++;
      $clsErroreNome=$clsErrore;
      $nome = "";
  }


  if(($cognome != "") && UT::CtrlLenght($cognome, 0, 25))
  {
      $clsErroreCognome= "";
  }
  else
  {
      $valido++;
      $clsErroreCognome=$clsErrore;
      $cognome="";
  }

  if(($email != "") && UT::CtrlLenght($email, 10, 100)  &&   filter_var($email, FILTER_VALIDATE_EMAIL))
  {
      $clsErroreEmail= "";
  }
  else
  {
      $valido++;
      $clsErroreEmail=$clsErrore;
      $email= "";
  }

  if(($telefono != "") && UT::CtrlLenght($telefono, 5, 20))
  {
      $clsErroreTelefono="";
  }
  else
  {
      $valido++;
      $clsErroreTelefono=$clsErrore;
      $telefono="";
  }

  if($testo != "")
  {
      $clsErroreTesto="";
  }
  else
  {
      $valido++;
      $clsErroreTesto= $clsErrore;
      $testo = "";
  }

  $inviato= ($valido == 0) ?true : false;

}
else{
  $nome="";
  $cognome ="";
  $email="";
  $telefono= "";
  $testo = "";
  $clsErroreNome="";
  $clsErroreCognome="";
  $clsErroreEmail="";
  $clsErroreTelefono="";
  $clsErroreTesto="";
  }



?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  <?php echo $str_json->contact->title;    ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $str_json->favicon;?>">  <!--## FAVICON DEL SITO ##########-->
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/contact.min.css" type="text/css">      
</head>
<body>
 <?php 

    require("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR  ###############


    if(!$inviato){?>
        <main>
        <div class="container">
            <form action="contact.php?inviato=1" method="POST" novalidate   ><!--#####   INIZIO DEL FORM   ##########################-->
                <h2>Compila il form per saperne di più</h2>
                    <div class="content">
                        <div class="inputbox">
                            <label for="Nome" <?php echo $clsErroreNome; ?>>Nome <span>*</span></label>
                            <input type="text" placeholder="nome" name="nome" id="Nome" required maxlength="25" value="<?php echo $nome; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="cognome" <?php echo $clsErroreCognome; ?>>Cognome <span>*</span></label>
                            <input type="text" placeholder="cognome" name="cognome" id="cognome" required maxlength="25"required value="<?php echo $cognome; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="email" <?php echo $clsErroreEmail; ?>>Email <span>*</span></label>
                            <input type="email" placeholder="E-mail" name="email" id="email" required required maxlength="100" minlength="10" value=" <?php echo $email; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="telefono" <?php echo $clsErroreTelefono; ?>>Telefono <span>*</span></label>
                            <input type="tel" placeholder="Telefono" name="telefono" id="telefono" required minlength="5" maxlength="20"  value=" <?php echo $telefono; ?>">
                        </div>
                        <label for="testo" <?php echo $clsErroreTesto; ?>>Testo <span>*</span></label>
                        <textarea name="testo" id="testo" placeholder="Dimmi qualcosa su di te" required maxlenght="500"  value=" <?php echo $testo; ?>"></textarea>


                    </div>
                    <div class="button-container">
                        <button type="submit">INVIA</button>
                    </div>
                
            </form><!--#######  FINE DEL FORM  ############################-->
        </div>
        
       </main>     
       <?php
    }else
    {
        $str = "Nome: %s <br>  " . 
            "Cognome : %s <br>" .
            "Email:%s <br>" .
            "telefono : %s <br>" .
            "Testo : %s <br>";  
        
            $str=   sprintf($str, $nome, $cognome, $email, $telefono, $testo);

            $str = str_replace("<br>", chr(10), $str); //sostituisco il <br> con il chr(10) per andare a capo nel file di testo
            $file="modulodati.txt";

            $rit = UT::scriviTesto($file, $str);//scrivo la stringa contenente i dati presi dal form sul file modulodati.txt

        }
    ?>

<?php 

    require("footer.php");  //### FOOTER DELLA PAGINA  ##########################

?>
</body>
</html>
