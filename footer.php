<footer><!--FOOTER SEMPLICE CONTENENTE ANCHE I DATI DI CONTATTO-->
        <div class="foot">
            <p>
                Copiright. All right deserved / 
                <a href="#" title="Visualizza la Privacy">Privacy</a> / 
                <a href="#" title="Visualizza i termini di utilizzo">Termini di utilizzo</a> / 
                <a href="#" title="Visualizza la preferenza sui cookie">Preferenze sui cookie</a> / 
                Contattami al seguente numero : 1112223334. <br>
            <?php
            foreach($str_json->servizi->social as $arr){
            print_r('<a href="#">' . $arr . '</a> /'  ); // CREO CON L'EACH UNA LISTA PER OGNI ELEMENTO ALL'INTERNO DI "Social"
            }     
            ?>
                Non vendere o condividere le mie informazioni personali 
            </p>
        </div>
    </footer>