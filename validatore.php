<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
require_once("contact.php"); // file contenente il form di contatto 
require_once("connessione.php");
use MieClassi\Utility as UT;
$inviato = UT::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato != 1 ) ? false:true; 
 if($inviato){
    $valido=0;
    //RECUPERO I DATI DAL FORM 
    $nome=UT::richiestaHTTP("nome");
    $cognome =UT::richiestaHTTP("cognome");
    $email=UT::richiestaHTTP("email");
    $telefono= UT::richiestaHTTP("telefono");
    $testo= UT::richiestaHTTP("testo");

    $clsErrore = 'class="errore"';

  //FACCIO LA VALIDAZIONE DEI DATI RECUPERATI DAL FORM UTILIZZANDO LO STESSO METODO VISTO NEGLI ESERCIZI DI PHP
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
  if(!$inviato){}else
  {
    $sql = "INSERT INTO utenti(nome,cognome,telefono,email,richiesta) VALUES (?,?,?,?,?)";
    $query= $mysqli->prepare($sql);
    $query->bind_param("sssss",$nome,$cognome,$telefono,$email,$testo);
    $risultato = $query->execute();

    if($risultato){
        echo "<script>alert('Dati inviato correttamente. Ti conttateremo al più presto. '); window.location.href = 'index.php';</script>";
        exit();
    }
    }
?>