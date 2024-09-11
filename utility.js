    //Creo una classe
    class Funzioni {
        //metodi della classe
        constructor(){
        }

        //Funzione per la validazione delle e-mail
        validaEMail(mail) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail)) {
                return true;
            } else {
                return false;
            }
        }

        //Funzione per il controllo del range di una stringa 
        controllaRangeStringa(stringa, min = null, max = null){
            let rit = 0;
            const n = stringa.length;
            if (min != null && n < min) {
                rit++;
            }
            if (max != null && n > max) {
                rit++;
            }
            return (rit == 0);
        }
        
        
        
    }
