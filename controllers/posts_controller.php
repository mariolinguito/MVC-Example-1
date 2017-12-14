<?php
    class PostsController {
        /**
         * Quando il metodo viene richiamato salviamo tutti i post in una variabile e poi viene
         * richiamato il file di index delle view dei post per poterli visualizzare.
         */
        public function index(){
            $posts = Post::all();
            require_once('views/posts/index.php');
        }

        /**
         * Il metodo show controlla che sia stato passato un id specifico di un post e se questo non
         * è stato passato allora chiama il metodo call per poter mostrare un messaggio di errore.
         * Nel caso contrario invece viene richiamato il metodo per poter mostrare quel post.
         */
        public function show(){
            if(!isset($_GET['id']))
                return call('pages', 'error');

            $posts = Post::find($_GET['id']);
            require_once('views/posts/show.php');
        }

        /**
         * Il metodo non fa altro che controllare che le informazioni sono state passate dal form correttamente e
         * quindi se queste sono state passate richiama il metodo statico del Model Add che inserisce le informazioni
         * nella tabella del database relativa ad essi. In seguito viene poi richiamata la view per mostrare la pagina
         * che indica che il post è stato inserito con successo.
         */
        public function add(){
            if(!isset($_POST['author']) || !isset($_POST['content']))
                return call('pages', 'error');

            Post::add($_POST['author'], $_POST['content']);
            require_once('views/posts/added.php');
        }

        /**
         * Il metodo del controller si occupa di richiamare il metodo statico del Model sul dato ID per poter eliminare
         * dalla tabella dei post quello specifico post. Nel caso in cui l'ID non sia stato specificato, allora viene
         * mostrato il messaggio di errore generato dal controller Pages. In seguito viene richiamato anche il file
         * che mostra il messaggio di avvenuta eliminazione.
         */
        public function delete(){
            if(!isset($_GET['id']))
                return call('pages', 'error');

            Post::delete($_GET['id']);
            require_once('views/posts/deleted.php');
        }

        /**
         * Il metodo del controller controlla che i parametri siano settati, se non lo sono allora viene mostrata la
         * view della pagina di errore, altrimetni si prosegue richiamadno il metodo statico del model Post. In seguito
         * ancora viene richiesta la view che mostra il messaggio dell'avvenuta modifica del post.
         */
        public function update(){
            if(!isset($_POST['id']) || !isset($_POST['author']) || !isset($_POST['content']))
                return call('pages', 'error');

            Post::update($_POST['id'], $_POST['author'], $_POST['content']);
            require_once('views/posts/updated.php');
        }
    }