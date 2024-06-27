<?php

namespace MieClassi;

/**
 * Questa classe contiene tutti i metodi utile
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
    if($str !== null){
        if(isset($_POST[$str])){
            $rit = $_POST[$str];
        }
        elseif(isset($_GET[$str])){
            $rit = $_GET[$str];
        }
    }

    return $rit;
 }


 /**
  *Funzione per leggere il testo di un file
  *
  * @param string $file nome del file
  *@return boolean|string 
  *
  */

  public static function leggiTesto($file)

 {
    $rit = false;
    if(!$fp = fopen($file, 'r')){
        echo ("non posso aprire il file $file <br>");
    }
    else{
        if(is_readable($file) === false){
            echo "Il file $file non è leggibile";
        }
        else{
            $rit = fread($fp, filesize($file));
        }
    }
    fclose($fp);
    return $rit;
 }



 /**
  *Funzione per leggere il testo di un file CSV
  *
  * @param string $file nome del file
  *
  *
  */

  public static function leggiTestoCSV($file)

 {
    $rit = false;
    $riga = 0;
    if(!$fp = fopen($file, 'r')){
        echo ("non posso aprire il file $file <br>");
    }
    else{
        if(is_readable($file) === false){
            echo "Il file non è leggibile <br>";
        }
        else{
            while(($data = fgetcsv($fp, null, ";")) !== false)
            {
                $rit[$riga] = $data;
                $riga++;
            }
        }
    }
    fclose($fp);
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

  public static function CtrlLenght($stringa, $min = null, $max=null){
    $rit = 0;
    $n = strlen($stringa);
    if( $min != null && $n < $min){
        $rit++;
    }
    if( $max != null && $n > $max){
        $rit++;
    }
    return ($rit == 0);

  }





 /**
  * Funzione per scrivere del testo all'interno di un file
  *
  *
  * @param string $file Nome del file 
  * @param string $stringa testo da scrivere all'interno del file
  * @return boolean
  */

  public static function scriviTesto($file, $stringa){
    $rit = false;
    if(!$fp = fopen($file, 'a'))
    {
        echo("non posso aprire il file $file");
    }
    else{
        if(is_writeable($file) === false){
            echo "il file $file non è scrivibile";
        }
        else{
            if(!fwrite($fp, $stringa)){
                echo '<link rel="stylesheet"  href="css/style.min.css" type="text/css">
                <style>
                div.risposta{
                    height:100vh;
                }   
                h1{
                text-align:center;
                padding:150px;
                }
                p{
                text-align:center;
                font-size:26px; 
                </style>
                <div class="risposta">
                    <h1> ERRORE: OPERAZIONE NON RIUSCITA </h1>
                    <p>Ti invitiamo a riprovare più tardi</p>
            
                </div>';
            }
            else{
                echo '<link rel="stylesheet"  href="css/style.min.css" type="text/css">
                <style>
                div.risposta{
                    height:100vh;
                }   
                h1{
                text-align:center;
                padding:150px;
                }
                p{
                text-align:center;
                font-size:26px; 
                </style>
                <div class="risposta">
                    <h1> OPERAZIONE SEGUITA CON SUCCESSO </h1>
                    <p>Verrai ricontattato appena possibile</p>
            
                </div>';
               $rit = true; 
            }
        }
    }
    fclose($fp);
    return $rit;
  }

}