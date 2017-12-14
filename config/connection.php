<?php
    /**
     * Class Db
     *
     * Con la classe Db abbiamo implementato un pattern noto come SINGLETON
     * che ci permette di accedere ad un metodo della classe stessa con una
     * sintassi semplificata e attraverso una semplice sintassi. 
    */

    class Db {
        private static $instance = NULL;

        /**
         * Db constructor.
         *
         * Il costruttore della classe è privato, cosi che nessun elemento
         * esterno ad essa possa istanziare questa classe stessa. Questo
         * perchè deve essere la classe a restituire un oggetto PDO attraverso
         * il quale poter connettersi al database. Detto in poche parole questo
         * significa che non possiamo istanziare questa classe concretizzandola
         * in un oggetto come faremmo solitamente: new Db().
         */
        private function __construct(){}
        private function __clone(){}

        /**
         * @return null|PDO
         *
         * Il metodo pubblico e statico viene richiamato per poter restituire
         * l'oggetto PDO attraverso il quale potersi connettere al database.
         * Questo oggetto è contenuto nella variabile $instance ed è restituita
         * con la sintassi semplificata: Db::getInstance().
         */
        public static function getInstance(){
            if(!isset(self::$instance)){
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$instance = new PDO('mysql:host=localhost;dbname=php_mvc', 'root', 'root', $pdo_options);
            }
            return self::$instance;
        }
    }