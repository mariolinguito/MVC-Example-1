<?php
    class Post {
        public $id;
        public $author;
        public $content;

        /**
         * Post constructor.
         * @param $id
         * @param $author
         * @param $content
         *
         * Con il costruttore della classe inizializziamo gli attributi privati definiti nella classe
         * con i valori che passiamo nel momento in cui istanziamo la classe stessa, e questi sono gli
         * attributi di ID, quello dell'autore e quello del contenuto del post.
         */
        public function __construct($id, $author, $content){
            $this->id      = $id;
            $this->author  = $author;
            $this->content = $content;
        }

        /**
         * @return array
         *
         * Quando il metodo all viene richiamato allora esegue una query SQL che seleziona tutti i post di
         * una determinata tabella e li inserisce in un array (che al termine viene restituito). Il modo in
         * cui viene riempito l'array è particolare, perchè viene istanziata questa stessa classe ad ogni
         * iterazione e quindi viene automaticamente richiamato il costruttore che è stato definito in modo
         * da inizializzare quegli attributi che sono stati dichiarati pubblici.
         */
        public static function all(){
            $list = [];

            // Qui si vede l'utilizzo del SINGLETON per il database, infatti possiamo richiamare il metodo
            // pubblico getInstance() anche direttamente, e ci restituisce un oggetto PDO che ci permette
            // di poter eseguire delle query SQL. La query che stiamo eseguendo è quella di selezione di tutti
            // i post che sono presenti nella tabella.
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM posts');

            foreach($req->fetchAll() as $post){
                $list[] = new Post($post['ID'], $post['Author'], $post['Content']);
            }

            return $list;
        }

        /**
         * @param $id
         * @return Post
         *
         * Il metodo statico cerca uno specifico post dato un id, e per fare questo prima si accerta che l'id
         * sia effettivamente un intero, e poi dopo aver definito e preparato la query SQL la esegue prendendo
         * tutti i risultati elaborandoli. Al termine del metodo viene restituito il richiamo del costruttore
         * della classe con in input i riferimenti del post trovato.
         */
        public static function find($id){
            // Anche in questo caso salviamo le informazioni circa un post specifico in un array, per cui dobbiamo
            // definire l'array vuoto e poi riempirlo con le informazioni che verranno raccolte con la query SQL.
            $list = [];
            $db = Db::getInstance();

            // Ci assicuriamo che l'id che è stato passato sia un intero, e per fare questo utilizziamo una funzione
            // messa a disposizione dal PHP stesso.
            $id = intval($id);

            // Fatto questo dobbiamo preparare la query per poter eseguirla con lo specifico id che ci è stato passato
            // in input, evitando quindi anche attacchi di tipo SQL Injection.
            $req = $db->prepare('SELECT * FROM posts WHERE ID = :id');

            // Sostituiamo poi :id con l'effettivo id che è stato passato, ed eseguiamo poi la query, che ci restituirà
            // dei risultati che dobbiamo catturare con fetch().
            $req->execute(array('id' => $id));
            $post = $req->fetch();

            // Istanziamo la classe del Model con le informazioni che sono state recuperate dalla query per poter
            // inizializzare gli attributi dichirati pubblici all'interno della classe stessa.
            $list[] = new Post($post['ID'], $post['Author'], $post['Content']);

            return $list;
        }

        /**
         * @param $author
         * @param $content
         *
         * Il metodo statico e pubblico prende in input due parametri, ossia quello dell'autore e quello del contenuto del
         * post da aggiungere. In seguito si recupera l'oggetto PDO che serve per poter eseguire la query SQL per poter
         * garantire l'inserimento del post nella tabella. Si prepara in seguito la query SQL e la si esegue con i parametri
         * che sono stati passati come input.
         */
        public static function add($author, $content){
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO posts (Author, Content) VALUES (:author, :content)');
            $req->execute(array('author'  => $author, 'content' => $content));
        }

        /**
         * @param $id
         *
         * Il metodo statico prende in input l'ID del post da eliminare e prepara la query per poter eliminare quel post
         * dalla tabella dei post. Non ci preoccupiamo del fatto che quell'ID esista o meno dato che questo controllo è
         * già stato fatto nel metodo del controller. In seguito viene eseguita la query su quell'ID.
         */
        public static function delete($id){
            $db = Db::getInstance();

            $req = $db->prepare('DELETE FROM posts WHERE ID = :id');
            $req->execute(array('id' => $id));
        }

        /**
         * @param $id
         * @param $author
         * @param $content
         *
         * IL meotodo statico prende in input l'ID del post da modificare, e le informazioni che devono essere modificate
         * e sostituite alle vecchie attraverso la query SQL che manipola il database. Abbiamo la variabile $db che in se
         * contiene l'oggetto PDO attraverso il quale possiamo eseguire la query, una volta che quest'ultima viene
         * preparata per evitare attacchi di SQL Injection.
         */
        public static function update($id, $author, $content){
            $db = Db::getInstance();

            $req = $db->prepare('UPDATE posts SET Author = :author, Content = :content WHERE ID = :id');
            $req->execute(array('author' => $author, 'content' => $content, 'id' => $id));
        }
    }