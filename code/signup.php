<?php

session_start();

require_once 'set_db.php';

$dbconn = pg_connect($connection_string)
    or die('Could not connect: ' . pg_last_error());

// Dal form
$mail_signup = strtoupper($_POST['mail']);
$indirizzo_signup = $_POST['indirizzo'];
$cellulare_signup = $_POST['cellulare'];
$isCompany = isset($_POST['check']);
$password_signup = $_POST['conf_password'];

// Hash della password
$hashed_password = password_hash($password_signup, PASSWORD_DEFAULT);

$query_mail = "SELECT mail FROM Utente WHERE mail = $1 UNION SELECT mail FROM Corriere WHERE mail = $1";
$result_mail = @pg_query_params($dbconn, $query_mail, array($mail_signup));

if (!$result_mail) {
    header("Location: auth.php");
    pg_close($dbconn);
    exit;
} elseif(pg_num_rows($result_mail) > 0){
        $_SESSION['error_message'] = 'email_exists';
        header('Location:auth.php');
        pg_free_result($result_mail);
        exit;
}else{

if ($isCompany) {
    $nome_azienda = strtoupper($_POST['nome_azienda']);
    $iva = $_POST['iva'];
    $tariffa_base = $_POST['tariffa_base'];
    $tariffa_peso = $_POST['tariffa_peso'];
    $tariffa_dimensioni = $_POST['tariffa_dimensioni'];

    $query_name = "SELECT nome FROM Corriere WHERE nome = $1";
    $result_name = @pg_query_params($dbconn, $query_name, array($nome_azienda));

    if (!$result_name) {
        header("Location: auth.php");
        pg_close($dbconn);
        exit;
    } elseif(pg_num_rows($result_name) > 0){
        $_SESSION['error_message'] = 'name_exists';
        header('Location:auth.php');
        pg_free_result($result_name);
        exit;
    }

    $query = "INSERT INTO Corriere (mail, nome, password_corriere, indirizzo_fisico, telefono, partitaIVA, tariffa_peso, tariffa_dimensioni, tariffa_base) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
    
    $result = pg_query_params($dbconn, $query, array($mail_signup, $nome_azienda, $hashed_password, $indirizzo_signup, $cellulare_signup, $iva, $tariffa_peso, $tariffa_dimensioni, $tariffa_base));
}
else {
    $nome = $_POST['nome'];
    $cognome= $_POST['cognome'];

    $query = "INSERT INTO Utente (mail, nome, cognome, indirizzo_ritiro, cellulare, password_utente) VALUES ($1, $2, $3, $4, $5, $6)";
    
    $result = @pg_query_params($dbconn, $query, array($mail_signup, $nome, $cognome, $indirizzo_signup, $cellulare_signup, $hashed_password));
}


if ($result) {
    if($isCompany){
        $_SESSION['isCompany'] = $isCompany;
        $_SESSION['nome_azienda'] = $nome_azienda;
        $_SESSION['iva'] = $iva;
        $_SESSION['tariffa_base'] = $tariffa_base;
        $_SESSION['tariffa_dimensioni'] = $tariffa_dimensioni;
        $_SESSION['tariffa_peso'] = $tariffa_peso;
    } else {
        $_SESSION['nome'] = $nome;
        $_SESSION['cognome'] = $cognome;
    }
    $_SESSION['indirizzo'] = $indirizzo_signup;
    $_SESSION['cellulare'] = $cellulare_signup;
    $_SESSION['password'] = $password_signup;
    $_SESSION['user'] = $mail_signup;
    header("Location: index.php");
    pg_free_result($result);

    pg_close($dbconn);
    exit;
} else {
    header("Location: auth.php");
    pg_close($dbconn);
    exit;
}

}
?>