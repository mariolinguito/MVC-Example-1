<?php
    class PagesController {
        /**
         * Il metodo pubblico deifnito nella classe richiama la pagina home che mostra delle determinate cose nel
         * layout che è stato definito.
         */
        public function home(){
            $firstName = 'John';
            $lastName  = 'Snow';
            require_once('views/pages/home.php');
        }

        /**
         * Il metodo pubblico definisce una funzione del controller PagesController, che mostra la view che riguarda
         * le informazioni dell'autore dell'applicazione MVC. Definisce una serie di variabili e richiede poi il
         * file della view per mostrarle formattate correttamente.
         */
        public function about(){
            $firstName    = 'Mario';
            $lastName     = 'Linguito';
            $myOccupation = 'Backend Developer';
            require_once('views/pages/about.php');
        }

        /**
         * Lo stesso fa il metodo pubblico error, solo che in questo caso mostra la pagina di errore, dato che non
         * è stata trovata alcuna corrispondenza di controller.
         */
        public function error(){
            require_once('views/pages/error.php');
        }
    }