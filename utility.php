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
            <div class="img"><img src="' . $pathFolder . $item["ImagePath"] . '" alt="IMG LAVORO"></div>
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
            <div class="img"><img src="' . $pathFolder . $item["ImagePath"] . '" alt="IMG LAVORO"></div>
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
     * Funzioni per la creazione in modo dinamico delle tabelle contenente gli elementi delle pagine
     * 
     */

     //CREAZIONE DELLA TABLE PER LA HOME PAGE
    public static function CreaTableHome($dati)
    {
        $str = "";
        foreach ($dati as $arr) {
            $str .= '
                    <div class="tabella Home_Page">
                        <table>
                            <thead><tr><th>ID<th>Titolo</th><th>Contenuto</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                            <tbody>
                                <tr><td>' .  $arr["idHome"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Contenuto"] . '</td><td><img src="IMG/' .  $arr["ImagePath"] . '" width="200" height="130" alt="IMG Homepage" style="border-radius: 15px;"> </td>
                                <td><a href="modifica_home.php?idHome='.$arr["idHome"].'">MODIFICA</a><a class="elimina" href="backend.php?idHome=' . $arr["idHome"] . '">ELIMINA</a></td></tr>
                            </tbody>
                        </table>
                    </div>';
        }
        return $str;
    }


    //CREAZIONE DELLA TABLE PER PAGINO "CHI SONO"
    public static function CreaTableChiSono($dati)
    {
        $str = '<div class="tabella Chi_Sono">
                            <table>
                                <thead><tr><th>ID<th>Titolo</th><th>Contenuto</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                                <tbody>';
        foreach ($dati as $arr) {
            $str .= '<tr><td>' .  $arr["idChiSono"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Contenuto"] . '</td><td><img src="IMG/' .  $arr["ImagePath"] . '" width="200" height="130" style="border-radius: 15px;" alt="img computer" > </td>
            <td><a href="modifica_chisono.php?idChiSono='.$arr["idChiSono"].'">MODIFICA</a><a class="elimina" href="backend.php?idChiSono=' . $arr["idChiSono"] . '">ELIMINA</a></td></tr>
            <tr><td>' .  $arr["idChiSono"] . '</td><td>' . $arr["Titolo2"] . '</td><td>' .  $arr["Contenuto2"] . '</td><td><img src="IMG/' .  $arr["ImagePath2"] . '" width="200" height="130" style="border-radius: 15px;" alt="developer" > </td>
            <td><a href="modifica_chisono.php?idChiSono='.$arr["idChiSono"].'">MODIFICA</a><a class="elimina" href="backend.php?idChiSono=' . $arr["idChiSono"] . '">ELIMINA</a></td></tr>';
        }
        $str .= '</tbody></table></div>';
        return $str;
    }


    //CREAZIONE DELLA TABLE PER I PROGETTI
    public static function CreaTableCard($dati)
    {
        $str = "<div class='tabella Card_Lavoro'>
                <table>
                <thead><tr><th>ID</th><th>Titolo</th><th>Descrizione</th><th>Immagine</th><th>Operazioni</th></tr></thead>
                <tbody>";
        foreach ($dati as $arr) {
            $str .= '  
                    <tr><td>' .  $arr["IdLavoro"] . '</td><td>' . $arr["titolo"] . '</td><td>' .  $arr["descrizione"] . '</td><td><img alt="img Lavoro" src="ImgLavori/' .  $arr["ImagePath"] . '" width="200" height="130" style="border-radius: 15px;"> </td>
                    <td><a href="modifica_progetto.php?IdLavoro='.$arr["IdLavoro"].'">MODIFICA</a><a class="elimina" href="backend.php?IdLavoro=' . $arr["IdLavoro"] . '">ELIMINA</a></td></tr>';
        }
        $str .= '</tbody>
                    <tfoot><tr><td colspan="5"><a class="aggiungi" href="aggiungi.php">AGGIUNGI</a></td></tr></tfoot>
                    </table>
                        </div>';
        return $str;
    }




    //CREAZIONE DELLA TABLE PER LA PAGE "SERVIZI OFFERTI"
    public static function CreaTableServizio($dati)
    {
        $str = "<div class='tabella Servizio'>
                <table>
                <thead><tr><th>ID</th><th>Titolo</th><th>Descrizione</th><th>Operazioni</th></tr></thead>
                <tbody>";
        foreach ($dati as $arr) {
            $str .= '  
                    <tr><td>' .  $arr["idServizio"] . '</td><td>' . $arr["Titolo"] . '</td><td>' .  $arr["Servizio"] . '</td>
                    <td><a href="modifica_servizi.php?idServzio='.$arr["idServizio"].'">MODIFICA</a><a class="elimina" href="backend.php?idServizio=' . $arr["idServizio"] . '">ELIMINA</a></td></tr>';
        }
        $str .= '</tbody></table>
                    </div>';
        return $str;
    }
    

    //CREAZIONE DELLA TABLE PER LA VISUALIZZAZIONE DEGLI UTENTI
    public static function CreaTableUtenti($dati)
    {
        $str = "<div class='tabella Servizio'>
                <table>
                <thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Recapiti</th><th>Richiesta</th><th>Operazioni</th></tr></thead>
                <tbody>";
                if($dati !== null){
        foreach ($dati as $arr) {
            $str .= '<tr><td>' . $arr["idUtente"] . '</td><td>' . $arr["nome"] . '</td><td>' . $arr["cognome"] . '</td><td>' . $arr["telefono"] . ' & ' . $arr["email"] . '</td><td>' . $arr["richiesta"] . '</td>
                    <td><a href="modificaUtenti.php?idUtente=' . $arr["idUtente"].'">MODIFICA</a><a class="elimina" id="eliminaUtente" href="backend.php?idUtente=' . $arr["idUtente"] . '">ELIMINA</a></td></tr>';
        }
    }else{
        $str .= '<tr><td colspan ="6" > Non ci sono utenti </td></tr>';
    }
        $str .= '</tbody></table>
                    </div>';
        return $str;
    }
 
}
