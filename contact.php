<?php
    require_once("validatore.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contattami</title>
    <link rel="icon" type="image/x-icon" href="IMG/faviconSito.png">  <!--## FAVICON DEL SITO ##########-->
    <link rel="stylesheet"  href="css/style.min.css" type="text/css">
    <link rel="stylesheet"  href="css/contact.min.css" type="text/css"> 
    <script src="utility.js"></script>
    <script> // Validazione con Javascript
            const FU = new Funzioni();
            window.onload = function () {
            const form = document.getElementById("form");
            const bott = document.getElementById("submit");
            
            bott.onclick = function () {
                console.log("submit");
                let valido = 0;
                const nome = document.getElementById("Nome").value;
                const lb_nome = document.getElementById("lb_nome");
                valido += nome != null && nome != "" && FU.controllaRangeStringa(nome, 0, 25) ? 0 : 1;
                console.log("VALIDO", valido);
                if (valido > 0) {
                    lb_nome.classList.add("errore");
                    console.log(lb_nome, "ramo1", nome);
                } else {
                    lb_nome.classList.remove("errore");
                    console.log(lb_nome, "ramo2", nome);
                }

                const cognome = document.getElementById("cognome").value;
                const lb_cognome = document.getElementById("lb_cognome");
                valido += cognome != null && cognome != "" && FU.controllaRangeStringa(cognome, 0, 25) ? 0 : 1;
                if (valido > 0) {
                    lb_cognome.classList.add("errore");
                    console.log(lb_cognome, "ramo1", cognome);
                } else {
                    lb_cognome.classList.remove("errore");
                    console.log(lb_cognome, "ramo2", cognome);
                }

                const email = document.getElementById("email").value;
                const lb_email = document.getElementById("lb_email");
                valido += email != null && email != "" && FU.controllaRangeStringa(email, 0, 25) && FU.validaEMail(email) ? 0 : 1;
                if (valido > 0) {
                    lb_email.classList.add("errore");
                    console.log(lb_email, "ramo1", email);
                } else {
                    lb_email.classList.remove("errore");
                    console.log(lb_email, "ramo2", email);
                }

                const telefono = document.getElementById("telefono").value;
                const lb_telefono = document.getElementById("lb_telefono");
                valido += telefono != null && telefono != "" && FU.controllaRangeStringa(telefono, 5, 20);
                if (valido > 0) {
                lb_telefono.classList.add("errore");
                console.log(lb_telefono, "ramo1", telefono);
                } else {
                lb_telefono.classList.remove("errore");
                console.log(lb_telefono, "ramo2", telefono);
                }
                    
                const testo = document.getElementById("testo").value;
                const lb_testo = document.getElementById("lb_testo");
                valido += testo != null && testo != "" && FU.controllaRangeStringa(testo, 10, 500);
                if (valido > 0) {
                    lb_testo.classList.add("errore");
                    console.log(lb_testo, "ramo1", testo);
                } else {
                    lb_testo.classList.remove("errore");
                    console.log(lb_testo, "ramo2", testo);
                }    
                };
            }
        </script> 
    <style>
        .errore{
        color: red;
    }
    </style>   
</head>
<body>
 <?php 

    require("nav_bar.php"); // HEADER DELLA PAGINA CONTENENTE LA NAVBAR  ###############


?>

        <main>
        <div class="container">
            <form action="contact.php?inviato=1" method="POST" novalidate   ><!--#####   INIZIO DEL FORM   ##########################-->
                <h2>Compila il form per saperne di più</h2>
                    <div class="content">
                        <div class="inputbox">
                            <label for="Nome" id="lb_nome"<?php echo $clsErroreNome; ?>>Nome<span>*</span></label>
                            <input type="text" placeholder="nome" name="nome" id="Nome" required maxlength="25" value="<?php echo $nome;?>">
                        </div>
                        <div class="inputbox">
                            <label for="cognome" id="lb_cognome" <?php echo $clsErroreCognome; ?>>Cognome <span>*</span></label>
                            <input type="text" placeholder="cognome" name="cognome" id="cognome" required maxlength="25" value="<?php echo $cognome; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="email" id="lb_email"<?php echo $clsErroreEmail; ?>>Email <span>*</span></label>
                            <input type="email" placeholder="E-mail" name="email" id="email" required maxlength="100" minlength="10" value=" <?php echo $email; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="telefono" id="lb_telefono" <?php echo $clsErroreTelefono; ?>>Telefono <span>*</span></label>
                            <input type="tel" placeholder="Telefono" name="telefono" id="telefono" required minlength="5" maxlength="20"  value=" <?php echo $telefono; ?>">
                        </div>
                        <label for="testo" id="lb_testo" <?php echo $clsErroreTesto; ?>>Richiesta <span>*</span></label>
                        <textarea name="testo" id="testo" placeholder="Dimmi qualcosa su di te" required><?php echo $testo;?></textarea>
                        <!-- LA TEXTAREA NON AMMETTE L'ATTRIBUTO VALUE QUINDI PER RISOLVERE IL PROBLEMA HO INSERITO $testo tra IL TAG DI APERTURA E CHIUSURA-->


                    </div>
                    <div class="button-container">
                        <button type="submit" id="submit">INVIA</button>
                    </div>
                
            </form><!--#######  FINE DEL FORM  ############################-->
        </div>
 
       </main>     

<?php 

    require("footer.php");  //### FOOTER DELLA PAGINA  ##########################

?>
</body>
</html>
