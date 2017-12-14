<?php
    /**
     * Richiamiamo il file per la connessione al database innanzitutto, poi verifichiamo
     * attraverso un semplice controllo sul flusso che siano settati i parametri controller
     * e action, e se sono settati allora inizializziamo delle variabili con quei valori,
     * altrimenti le variabili sono settate con dei valori di default. Alla fine richiamiamo
     * il file di layout che si trova nella cartella views/.
     *
     * Ovviamente è il file index che riceve e gestisce tutte le richieste, ed è questo file
     * infatti che si occupa di recuperare i parametri e di inizializzare quelle variabili che
     * saranno utilizzate dal controller per poter aggiornare le views che visualizzerà l'utente.
    */

    require_once('config/connection.php');

    if(isset($_GET['controller']) && isset($_GET['action'])){
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    }else{
        $controller = 'pages';
        $action     = 'home';
    }

    require_once('views/layout.php');
