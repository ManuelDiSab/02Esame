<?php 
session_start();
require_once("utility.php");// FUNZIONI UTILI
require_once("connessione.php");// CONNESSIONE AL DB
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Area Privata</title>
    <link rel="stylesheet" href="css/style.min.css" type="text/css"> 
    <link rel="stylesheet" href="css/contact.min.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">  <!--## FAVICON DEL SITO ##########-->
    <script src="utility.js"></script>
</head>
<body>
<?php   require_once("nav_bar.php"); // RICHIAMO DELLA NAVBAR ?>
    <main>
        <div class="container">
            <form action="login.php" method="POST" novalidate>   <!--#####   INIZIO DEL FORM   ########################## -->
                        <div class="content">
                            <div class="inputbox">
                                <label for="user" id="lb_user">Username <span>*</span></label>
                                <input type="text" placeholder="Username" name="user" id="user" required maxlength="25">
                            </div>                        
                            <div class="inputbox">
                                <label for="pass" id="lb_password">Password <span>*</span></label>
                                <input type="password" placeholder="password" name="pass" id="pass" required maxlength="30">
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="submit" name="login" id="login">LOGIN</button>    
                        </div>

                    </form><!--#######  FINE DEL FORM  ############################-->
                </div>
            </main>
            <?php
            require_once("footer.php"); // RICHIAMO DEL FOOTER
            ?>
</body>
</html>