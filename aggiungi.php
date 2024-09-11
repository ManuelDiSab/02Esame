<?php
require_once("connessione.php");
require_once("utility.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png"> <!--## FAVICON DEL SITO ##########-->
    <title>Aggiungi Card</title>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/contact.min.css">
</head>
<body>
    <?php require_once("nav_bar.php"); ?>
    <main>
        <div class="container">
            <form action="backend.php" method="POST" novalidate enctype="multipart/form-data"> <!--#####   INIZIO DEL FORM   ########################## -->
                <h2>AGGIUNGI UN LAVORO </h2>
                <div class="content">
                    <div class="inputbox">
                        <label for="titolo" id="lb_titolo">Titolo</label>
                        <input type="text" name="titolo" id="titolo"  maxlength="15" required>
                        <input type="hidden" name="check" value="$caso">
                    </div>
                    <div class="inputbox">
                        <label for="descrizione" id="lb_descrizione"> Contenuto </label>
                        <textarea type="text"  name="descrizione" id="descrizione"  maxlength="500" required></textarea>
                    </div>
                    <div class="inputbox">
                        <label for="img" id="lb_img"> Immagine </label>
                        <input type="file"  name="img" id="img" accept=".jpg, .jpeg, .png, " required>
                    </div>
                    <strong>N.B.</strong> le estensioni accettate sono: jpg,jpeg,png;
                </div>
                <div class="button-container">
                    <button type="submit" name="submit" id="submit">AGGIUNGI</button>
                </div>

            </form><!--#######  FINE DEL FORM  ############################-->
        </div>
    </main>
</body>
    <?php require_once("footer.php"); ?>
</html>