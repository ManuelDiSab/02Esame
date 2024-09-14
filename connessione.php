<?php
 /**
  * definisco le variabili per la connessione al database
  */

//   $indirizzo = "31.11.39.170";
//   $db = "Sql1811982_1";
//   $utente = "Sql1811982";
//   $password = "Disabatino63!";
$indirizzo = "localhost";
$db = "manueldisabatino.it";
$utente = "root";
$password = "";

  /**
   * CONNESSIONE A MySQL ATTRAVERSO LE MySQLi
   */

$mysqli = new mysqli($indirizzo,$utente,$password,$db);
if( $mysqli->connect_error) {
    die('errore di connessione (' . $mysqli->connect_errno . ')' . $mysqli ->connect_error );
}
else {
     //echo 'connesso con le MySQLi a' . $mysqli->host_info . '<br>';
}   
/**
 * CONNESSIONI ATTRAVERSO LE PDO
 */
try {
    $pdo = new PDO(
        "mysql:host =$indirizzo;dbname=$db",
        $utente,
        $password
    );
    //  echo ( "<br><br> Connesso con le PDO a MySQL");
}
catch (PDOException $e){
    echo "<br><br> Errore PDO :" . $e -> getMessage();
    die();
}
