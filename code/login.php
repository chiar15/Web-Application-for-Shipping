<?php
// Inizia la sessione
session_start();

require_once 'set_db.php';

$dbconn = pg_connect($connection_string)
    or die('Impossibile connettersi al database: ' . pg_last_error());

// Dal form
$mail_login = strtoupper($_POST['mail_login']);
$password_login = $_POST['password_login'];

$query = 'SELECT password_utente, \'utente\' AS Tipo FROM Utente WHERE mail = $1 UNION SELECT password_corriere, \'corriere\' AS Tipo FROM Corriere WHERE mail=$1';
$result = @pg_query_params($dbconn, $query, array($mail_login));

// Controlla se l'utente esiste nel database
if (pg_num_rows($result) == 0) {
    $_SESSION['error_message'] = 'user_not_found';
    header('Location:auth.php');
    pg_close($dbconn);
    exit;
}

// La password presente in db è stata codificata quindi va decodificata
$hashed_password = pg_fetch_result($result, 0, 'password_utente');

// Verifica la password
if (password_verify($password_login, $hashed_password)) {
    $_SESSION['user'] = $mail_login;
    $row = pg_fetch_assoc($result);
    $isCompany = ($row['tipo'] == 'corriere') ? true : false;

    if($isCompany){
        $query = 'SELECT * FROM Corriere WHERE mail = $1';
        $result = @pg_query_params($dbconn, $query, array($mail_login));

        if(!$result){
            $_SESSION['error_message'] = 'user_not_found';
            header('Location:auth.php');
            pg_close($dbconn);
            exit;
        } 
        
        $row = pg_fetch_assoc($result);

        $_SESSION['isCompany'] = $isCompany;
        $_SESSION['indirizzo'] = $row['indirizzo_fisico'];
        $_SESSION['cellulare'] = $row['telefono'];
        $_SESSION['nome_azienda'] = strtoupper($row['nome']);
        $_SESSION['iva'] = $row['partitaiva'];
        $_SESSION['tariffa_base'] = $row['tariffa_base'];
        $_SESSION['tariffa_dimensioni'] = $row['tariffa_dimensioni'];
        $_SESSION['tariffa_peso'] = $row['tariffa_peso'];

    } else{
        $query = 'SELECT * FROM Utente WHERE mail = $1';
        $result = @pg_query_params($dbconn, $query, array($mail_login));

        if(!$result){
            $_SESSION['error_message'] = 'user_not_found';
            header('Location:auth.php');
            pg_close($dbconn);
            exit;
        } 

        $row = pg_fetch_assoc($result);
        
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['cognome'] = $row['cognome'];
        $_SESSION['indirizzo'] = $row['indirizzo_ritiro'];
        $_SESSION['cellulare'] = $row['cellulare'];
    }
    $_SESSION['password'] = $password_login;

    header('Location: index.php');

    pg_free_result($result);

    pg_close($dbconn);
    exit;
} else {
    $_SESSION['error_message'] = 'wrong_psws';
    header('Location:auth.php');
    pg_close($dbconn);
    exit;
}


?>