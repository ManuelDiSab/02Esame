<?php 
require_once("utility.php"); // file contenente alcune funzioni utili
use MieClassi\Utility as UT;
$file = "dati.json"; //file json da cui prendere i dati 
$str_json = json_decode(UT::leggiTesto($file));  
?>
<header>
        <div class="navbar"><!-- ####### INIZIO DEL MENU DI NAVIGAZIONE ############################################-->
            <input type="checkbox" id="controllo">
            <label for="controllo" class="label-controllo">
                <span></span>
            </label>
            <a class="logo" href="<?php echo $str_json->index->url;?>"><img src="IMG/MANUEL.png"  alt="logo" title="logo" width="150"></a>
            <ul class="menu">
                    <!-- SE LA FLAG E' TRUE ALLORA AL CLICCARE SI TONERA' ALL' INIZIO DELLA PAGINA ALTRIMENTI SI APRIRA' UNA NUOVA PAGINA  -->
                    <li><a href="<?php echo $str_json->index->url;?>" target="_self">HOME PAGE</a></li>
                    <li><a href="<?php echo $str_json->chi_sono->url;?>" target="_self">CHI SONO</a></li>
                    <li><a href="<?php echo $str_json->servizi->url;?>" target="_self">SERVIZI OFFERTI</a></li>
                    <li><a id="button" href="<?php echo $str_json->contact->url;?>" target="_blank" style="text-decoration: none;  " title="Contattami">CONTACT</a></li>
                </ul>               
        </div><!--############## FINE DEL MENU DI NAVIGAZIONE ############################-->
    </header>
