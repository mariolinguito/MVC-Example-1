<?php
    /**
     * @param $controller Parametro che è stato definito nell'entry point, e definisce il controller.
     * @param $action Questo parametro invece definisce l'azione da compiere.
    */

    function call($controller, $action){
        // Quando viene richiamata la funzione call() automaticamente viene incluso anche il controller
        // relativo a quel parametro che è stato specificato in input alla funzione stessa.
        require_once('controllers/' . $controller . '_controller.php');

        // Viene controllato il parametro, e se questo corrisponde a 'pages' allora viene istanziato il
        // controller, ossia viene istanziata la classe creando l'oggetto controller.
        switch($controller){
            case 'pages':
                $controller = new PagesController();
                break;
            case 'posts':
                // Se vogliamo mostrare tutti i post che sono stati salvati nel database allora dobbiamo
                // includere anche il model dei posts, ed ovviamente istanziare la classe del controller
                // relativo come fatto nel punto appena precedente.
                require_once('models/post.php');
                $controller = new PostsController();
                break;
        }

        // Infine viene richiamata l'azione del controller, che si occuperà quindi di mostrare nel
        // layout il contenuto dinamico richiamato.
        $controller->{$action}();
    }

    // In questo modo stiamo definendo una lista di controller specifici che possono essere richiamati
    // in particolare per pages possono essere richiamati i parametri home ed error. Questo lo si fa
    // con un array.
    $controllers = array('pages'  => ['home', 'error', 'about'],
                         'posts' => ['index', 'show', 'add', 'update', 'delete']);

    // Per prima cosa dobbiamo controllare che il controller che si intende richiamare sia disponibile
    // nell'array che abbiamo definito, quindi si controlla che l'arrray abbia una chiave che esista
    // tra le chiavi dell'array.
    if(array_key_exists($controller, $controllers)){
        // Nel secondo controllo si verifica che l'azione sia contemplata nell'array che abbiamo definito
        // e se questo non è vero allora rimandiamo l'utente in una pagina di errore, ossia richiamiamo la
        // funzione definita in precedenza con dei parametri specifici di default: pages ed error.
        if(in_array($action, $controllers[$controller])){
            call($controller, $action);
        }else{
            call('pages', 'error');
        }
    }else{
        call('pages', 'error');
    }
