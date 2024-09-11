<?php

namespace MieClassi;

/**
 * Questa classe contiene diverse funzioni utili 
 *  
 */
class Utility
{
    /**
     * Funzione per estrarre  dal $_GET o dal $_POST la proprietà richiesta.
     * 
     *
     *  @param string Proprietà da ricercare
     * @return string|null
     */
    public static function richiestaHTTP($str)
    {
        $rit = null;
        if ($str !== null) {
            if (isset($_POST[$str])) {
                $rit = $_POST[$str];
            } elseif (isset($_GET[$str])) {
                $rit = $_GET[$str];
            }
        }
        return $rit;
    }
    /**
     *
     *Funzione per capire se una stringa sta all'interno di un range di caratteri
     *
     *@param string $stringa stringa da controllare
     *@param integer $max Lunghezza massima
     *@param integer $min Lunghezza minima
     *@return boolean
     */
    public static function CtrlLenght($stringa, $min = null, $max = null)
    {
        $rit = 0;
        $n = strlen($stringa);
        if ($min != null && $n < $min) {
            $rit++;
        }
        if ($max != null && $n > $max) {
            $rit++;
        }
        return ($rit == 0);
    }
    /**
     * 
     * 
     * Funzione per la creazione delle card dei lavori in modo dinamico
     * 
     * @param string $pathFolder stringa contenente il percorso della cartella immagini lavori
     * @param array $arr array con i dati da inserire 
     * @return string
     */
    public static function creaCard($pathFolder, $arr)
    {
        $str = "";
        foreach ($arr as $item) {
            $str .=
                '<div class="card">
            <div class="img"><img src="' . $pathFolder . $item["ImagePath"] . '" alt=""></div>
            <div class="content-card">
                <a href="lavoro.php?selezionato=' . $item["idLavoro"] . '" title="' . $item["titolo"] . '">
                ' . $item["descrizione"] . '
                <br>clicca per saperne di più
                </a>
            </div>
        </div>';
        }
        return $str;
    }
    public static function crea3Card($pathFolder, $arr)
    {
        $str = "";
        $i = 0;
        foreach ($arr as $item) {
            if ($i == 3) { //VOGLIO SOLO VISUALIZZARE I PRIMI 3 LAVORI
                break;
            }
            $str .=
                '<div class="card">
            <div class="img"><img src="' . $pathFolder . $item["ImagePath"] . '" alt=""></div>
            <div class="content-card">
                <a href="lavoro.php?selezionato=' . $item["idLavoro"] . '" title="' . $item["titolo"] . '">
                ' . $item["descrizione"] . '
                <br>clicca per saperne di più
                </a>
            </div>
        </div>';
            $i++;
        }
        return $str;
    }
    /**
     * 
     * Fuznione per la creazione delle sezioni per la pagina dei servizi 
     * 
     * 
     */
    public static function Creaservizio($arr)
    {
        $str = "";
        foreach ($arr as $item) {
            $str .= "<li> <h3>" . $item["Titolo"] . "</h3>" . "<br>" . $item["Servizio"] . "</li>";
        }
        return $str;
    }
    /**
     * Funzione per la creazione in modo dinamico delle tabelle contenente gli elementi delle pagine
     * 
     */
    public static function CreaTableHome($dati)
    {
        $str = "";
        foreach ($dati as $arr) {
            $str .= '
                    <div class="tabella Home_Page">
                        <table>
                            <thead><tr><th>ID</td><th>Titolo</th><th>Contenuto</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                            <tbody>
                                <tr><td>' .  $arr["idHome"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Contenuto"] . '</td><td><img src="IMG/' .  $arr["ImagePath"] . '" width="200" height="130" style="border-radius: 15px;"></img> </td>
                                <td><button><a href="modifica_home.php?idHome='.$arr["idHome"].'">MODIFICA</a></button><button><a id="elimina" href="backend.php?idHome=' . $arr["idHome"] . '">ELIMINA</a></button></td></tr>
                            </tbody>
                        </table>
                    </div>';
        }
        return $str;
    }
    public static function CreaTableChiSono($dati)
    {
        $str = '<div class="tabella Chi_Sono">
                            <table>
                                <thead><tr><th>ID</td><th>Titolo</th><th>Contenuto</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                                <tbody>';
        foreach ($dati as $arr) {
            $str .= '<tr><td>' .  $arr["idChiSono"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Contenuto"] . '</td><td><img src="IMG/' .  $arr["ImagePath"] . '" width="200" height="130" style="border-radius: 15px;"></img> </td>
            <td><button><a href="modifica_chisono.php?idChiSono="'.$arr["idChiSono"].'">MODIFICA</a></button><button><a id="elimina"href="backend.php?idChiSono=' . $arr["idChiSono"] . '">ELIMINA</a></button></td></tr>
            <tr><td>' .  $arr["idChiSono"] . '</td><td>' . $arr["Titolo2"] . '</td><td>' .  $arr["Contenuto2"] . '</td><td><img src="IMG/' .  $arr["ImagePath2"] . '" width="200" height="130" style="border-radius: 15px;"></img> </td>
            <td><button><a href="modifica_chisono.php?idChiSono="'.$arr["idChiSono"].'">MODIFICA</a></button><button><a id="elimina"href="backend.php?idChiSono=' . $arr["idChiSono"] . '">ELIMINA</a></button></td></tr>';
        }
        $str .= '</tbody></table></div>';
        return $str;
    }

    public static function CreaTableCard($dati)
    {
        $str = "<div class='tabella Card_Lavoro'>
                <table>
                <thead><tr><th>ID</th><th>Titolo</th><th>Descrizione</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                <tbody>";
        foreach ($dati as $arr) {
            $str .= '  
                    <tr><td>' .  $arr["IdLavoro"] . '</td><td>' . $arr["titolo"] . '</td><td>' .  $arr["descrizione"] . '</td><td><img src="ImgLavori/' .  $arr["ImagePath"] . '" width="200" height="130" style="border-radius: 15px;"></img> </td>
                    <td><button><a href="modifica_progetto.php?IdLavoro='.$arr["IdLavoro"].'">MODIFICA</a></button><button><a id="elimina" href="backend.php?IdLavoro=' . $arr["IdLavoro"] . '">ELIMINA</a></button></td></tr>';
        }
        $str .= '</tbody>
                    <tfoot><tr><td colspan="5"><button><a id="aggiungi" href="aggiungi.php">AGGIUNGI</a></button></td></tr></tfoot>
                    </table>
                        </div>';
        return $str;
    }

    public static function CreaTableServizio($dati)
    {
        $str = "<div class='tabella Servizio'>
                <table>
                <thead><tr><th>ID</th><th>Titolo</th><th>Descrizione</th><th>Operazioni</th></tr></thead>
                <tbody>";
        foreach ($dati as $arr) {
            $str .= '  
                    <tr><td>' .  $arr["idServizio"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Servizio"] . '</td>
                    <td><button><a href="modifica_servizi.php?idServzio="'.$arr["idServizio"].'">MODIFICA</a></button><button><a id="elimina" href="backend.php?idServizio=' . $arr["idServizio"] . '">ELIMINA</a></button></td></tr>';
        }
        $str .= '</tbody></table>
                    </div>';
        return $str;
    }
    
    public static function CreaTableUtenti($dati)
    {
        $str = "<div class='tabella Servizio'>
                <table>
                <thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Recapiti</th><th>Richiesta</th><th>Operazioni</th></tr></thead>
                <tbody>";
                if($dati !== null){
        foreach ($dati as $arr) {
            $str .= '<tr><td>' . $arr["idUtente"] . '</td><td>' . $arr["nome"] . '</td><td>' . $arr["cognome"] . '</td><td>' . $arr["telefono"] . ' & ' . $arr["email"] . '</td><td>' . $arr["richiesta"] . '</td>
                    <td><button><a href="modificaUtenti.php?idUtente=' . $arr["idUtente"].'">MODIFICA</a></button><button><a id="elimina" name="eliminaUtente" href="backend.php?idUtente=' . $arr["idUtente"] . '">ELIMINA</a></button></td></tr>';
        }
    }else{
        $str .= '<tr><td colspan ="6" > Non ci sono utenti </td></tr>';
    }
        $str .= '</tbody></table>
                    </div>';
        return $str;
    }
    /**
     * FUNZIONE PER LA CREAZIONE DI ALCUNI FORM PER LA MODIFICA
     * 
     */
    public static function FormHome($dati)
    {
        $str = '<div class="container">
            <form action="backend.php" method="POST" novalidate enctype="multipart/form-data">
                <h2>MODIFICA </h2>
                <div class="content">';
        foreach ($dati as $arr) {
            $str .= '<div class="inputbox">
                        <label for="titolo" id="lb_titolo">Titolo</label>
                        <input type="text" name="titolo" id="titolo"  maxlength="15" value="' . $arr["Titolo"] . '">
                        <input type="hidden" name="check" value="">
                    </div>
                    <div class="inputbox">
                            <label for="descrizione" id="lb_descrizione"> Contenuto </label>
                            <textarea type="text"  name="descrizione" id="descrizione"  maxlength="500" >' . $arr["Contenuto"] . '</textarea>
                    </div>
                    <div class="inputbox">
                            <label for="img" id="lb_img"> Immagine </label>
                            <input type="file"  name="img" id="img" accept=".jpg, .jpeg, .png">
                    </div>
                        <strong>N.B.</strong> le estensioni accettate sono: jpg,jpeg,png;
                    </div>';
        }
        $str .= '<div class="button-container">
                    <button type="submit" name="modifica" id="modifica">MODIFICA</button>
                </div>
                </form></div>';
        return $str;
    }
    public static function FormModificaUtenti($dati)
    {
        $str = '<div class="container">
            <form action="backend.php" method="POST" novalidate >
                <h2>MODIFICA </h2>
                <div class="content">';
        foreach ($dati as $arr) {
            $str .= '<div class="inputbox">
                        <label for="nome" id="lb_nome">Nome</label>
                        <input type="text" name="nome" id="nome"  maxlength="15" value="' . $arr["nome"] . '">
                    </div>
                    <div class="inputbox">
                            <label for="cognome" id="lb_cognome"> Cognome </label>
                            <input type="text"  name="cognome" id="cognome"  maxlength="15" value="' . $arr["cognome"] . '">
                    </div>
                    <div class="inputbox">
                        <label for="email" id="lb_email">Email</label>
                        <input type="email" name="email" id="email"  maxlength="30" value="' . $arr["email"] . '">
                    </div>
                    <div class="inputbox">
                        <label for="telefono" id="lb_telefono">Telefono</label>
                        <input type="telefono" name="telefono" id="telefono"  maxlength="15" value="' . $arr["telefono"] . '">
                    </div>
                    <label for="richiesta" id="lb_richiesta" <?php echo $clsErroreTesto; ?>>Richiesta</label>
                    <textarea name="richiesta" id="richiesta" placeholder="Dimmi qualcosa su di te" required>'.$arr["richiesta"] .'</textarea>';
        }
        $str .= '<div class="button-container">
                    <button type="submit" name="modifica" id="modifica">MODIFICA</button>
                </div>
                </form></div>';
        return $str;
    }
}
