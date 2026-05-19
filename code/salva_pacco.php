<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: auth.php");
        exit;
    }

    require_once 'set_db.php';

    $dbconn = pg_connect($connection_string)
        or die('Could not connect: ' . pg_last_error());

    // Dal fieldset
    $nome_corriere = $_POST['corriere'];

    // Recupero la mail del corriere
    $query_mail_corriere = "SELECT mail, tariffa_base, tariffa_peso, tariffa_dimensioni FROM Corriere WHERE nome = $1";
    $result_mail_corriere = pg_query_params($dbconn, $query_mail_corriere, array($nome_corriere));

    if (!$result_mail_corriere) {
        header("Location: prenotazione.php");
        pg_close($dbconn);
        exit;
    } 

    $row =pg_fetch_assoc($result_mail_corriere);
    $mail_corriere = $row['mail'];
    $tariffa_peso = $row['tariffa_peso'];
    $tariffa_dimensioni = $row['tariffa_dimensioni'];
    $tariffa_base = $row['tariffa_base'];

    // Recupero la mail utente della sessione
    $mail_utente = $_SESSION['user'];

    // Dal form - destinatario 
    $nome_dest = $_POST['nome_destinatario'];
    $cognome_dest = $_POST['cognome_destinatario'];
    $indirizzo_dest = $_POST['indirizzo_destinatario'];
    $cellulare_dest = $_POST['cellulare_destinatario']; // recupero la mail di bartocazzolini dal nome

    // Dal form - pacco
    $peso = $_POST['peso'];
    $altezza = $_POST['altezza'];
    $larghezza = $_POST['larghezza'];
    $spessore = $_POST['spessore'];
    // Calcolo il prezzo del pacco
    $prezzo = $tariffa_peso * $peso + $tariffa_dimensioni * ($altezza * $larghezza * $spessore)/50 + $tariffa_base;


    if(isset($_POST['note'])) {
        $note = $_POST['note'];
        $query = "INSERT INTO PACCO(Mail_utente, Mail_corriere, nome_corriere, nome_destinatario, cognome_destinatario, indirizzo_destinatario, cellulare_destinatario, prezzo, note_speciali, stato, altezza, larghezza, spessore, peso)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9,'In elaborazione', $10, $11, $12, $13)";
        $result = pg_query_params($dbconn, $query, 
            array($mail_utente, $mail_corriere, $nome_corriere, $nome_dest, 
            $cognome_dest, $indirizzo_dest, $cellulare_dest, $prezzo, $note, 
            $altezza, $larghezza, $spessore, $peso));
    } else {
        $query = "INSERT INTO PACCO(Mail_utente, Mail_corriere, nome_corriere, nome_destinatario, cognome_destinatario, indirizzo_destinatario, cellulare_destinatario, prezzo, note_speciali, stato, altezza, larghezza, spessore, peso)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, NULL,'In elaborazione', $9, $10, $11, $12)";
        $result = pg_query_params($dbconn, $query, 
            array($mail_utente, $mail_corriere, $nome_corriere, $nome_dest, 
            $cognome_dest, $indirizzo_dest, $cellulare_dest, $prezzo,  
            $altezza, $larghezza, $spessore, $peso));
    }

    if(!$result) {
        header("Location: prenotazione.php");
        pg_close($dbconn);
        exit;
    }

    // Vado su tracking (DA CAMBIARE)
    header("Location: index.php");
    pg_free_result($result);
    pg_free_result($result_mail_corriere);

    pg_close($dbconn);

?>