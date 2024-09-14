<?php 
session_start(); // Inizio la sessione
require_once("connessione.php");
$risultato = $mysqli->query("SELECT * FROM privato WHERE Id = '1'");
$riga = mysqli_fetch_array($risultato);
$pass = "";
$user = ""; 
if(isset($_POST["login"])){ // Verifico se il form viene inviato 
    $user = (isset($_POST['user'])) ? trim($_POST['user']) : ''; //La variabile inviata dal form viene messa all'interno di user
    $pass = (isset($_POST['pass'])) ? trim($_POST['pass']) : ''; //La variabile inviata dal form viene messa all'interno di password
}
    $pass = hash("SHA512", $pass); // password codificata con SHA512
    $query = $mysqli->query("SELECT Id, user, pass FROM privato WHERE user = '$user' AND pass = '$pass'");

if(mysqli_num_rows($query) == 1){
    $login = mysqli_fetch_array($query);  // Salvo all'interno della variabile $login l'array

    $_SESSION['login'] = $login["Id"]; //prelevo l'id dall'array

    $_SESSION['login'] = array($login["Id"], $login["user"],  $login["pass"]);
    echo $_SESSION["login"][0];
    echo $_SESSION["login"][1];

    header('Location: backend.php');
}
else{
    echo "<script>alert('Password o Username errati $pass')</script>";
    header("Refresh:0 url=AreaPrivata.php");
    
}
?>