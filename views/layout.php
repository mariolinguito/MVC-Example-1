<html>
    <head>
        <title>Layout</title>
        <meta charset="utf-8"/>
    </head>
    <body>
    <a href="?controller=pages&action=home">Home</a> /
    <a href="?controller=posts&action=index">Posts</a> /
    <a href="?controller=pages&action=about">About</a>
    <?php
        /**
         * Dobbiamo considerare che questo contenuto sarà modificato dinamicamente
         * dal controller che dovrà mostrare un messaggio in relazione alle azioni
         * dell'utente. Ad esempio: se l'utente si trova in una pagina che non esiste
         * allora viene mostrato un messaggio di errore; viceversa, se l'utente si
         * trova in una specifica pagina, il contenuto di questo layout (che ricordiamo
         * è stato inserito anche nell'index (ossia l'entry point dell'applicazione))
         * cambia dinamicamente.
        */

        require_once('routes.php');
    ?>
    </body>
</html>