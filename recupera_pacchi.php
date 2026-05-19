<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'set_db.php';
    $user = $_SESSION['user'];

    $dbconn = pg_connect($connection_string)
    or die('Impossibile connettersi al database: ' . pg_last_error());

    if(isset($_SESSION['isCompany'])) {
        $query = 'SELECT * FROM Pacco WHERE mail_corriere = $1';
        $result = @pg_query_params($dbconn, $query, array($user));

        // Fallimento query
        if(!$result) {
            header("Location: index.php");
            pg_close($dbconn);
            exit;
        }

    } else {

        $query = 'SELECT * FROM Pacco WHERE mail_utente = $1';
        $result = @pg_query_params($dbconn, $query, array($user));

        // Fallimento query
        if(!$result) {
            header("Location: index.php");
            pg_close($dbconn);
            exit;
        }
    }

    // Creo gli array 
    $inElaborazione = array();
    $inTransito = array();
    $consegnato = array();
    $rifiutato = array();

    // Suddivido i pacchi pazzi
    while ($row = pg_fetch_assoc($result)) {
        $stato = $row['stato'];
        switch ($stato) {
            case 'In elaborazione':
                $inElaborazione[] = $row;
                break;
            case 'In transito':
                $inTransito[] = $row;
                break;
            case 'Rifiutato':
                $rifiutato[] = $row;
                break;
            case 'Consegnato':
                $consegnato[] = $row;
                break;
            default:
                $inElaborazione[] = $row;
                break;
        }
    }

    pg_free_result($result);

    pg_close($dbconn);


?>