<?php
    session_start();

    require_once "set_db.php";

    $dbconn = pg_connect($connection_string)
    or die('Could not connect: ' . pg_last_error());

    $isCompany = isset($_SESSION['isCompany']);
    $mail_update = strtoupper($_POST['mail_update']);
    $psw_update = $_POST['psw_update'];
    $address_update = $_POST['address_update'];
    $cellphone_update = $_POST['cellphone_update'];
    $name_update = $_POST['name_update'];

    $hashed_password = password_hash($psw_update, PASSWORD_DEFAULT);

    $saved_mail = $_SESSION['user'];

    if($mail_update !== $saved_mail){
        $query_mail = "SELECT mail FROM Utente WHERE mail = $1 UNION SELECT mail FROM Corriere WHERE mail = $1";
        $result_mail = @pg_query_params($dbconn, $query_mail, array($mail_update));

        if (!$result_mail) {
            header("Location: user.php");
            pg_close($dbconn);
            exit;
        } elseif(pg_num_rows($result_mail) > 0){
            $_SESSION['error_message'] = 'email_exists';
            header('Location:user.php');
            pg_free_result($result_mail);
            exit;
        }
    }

    if($isCompany){
        $saved_name = $_SESSION['nome_azienda'];

        if($saved_name !== strtoupper($name_update)){
            $query_name = "SELECT nome FROM Corriere WHERE nome = $1";
            $result_name = @pg_query_params($dbconn, $query_name, array(strtoupper($name_update)));

            if (!$result_name) {
                header("Location: user.php");
                pg_close($dbconn);
                exit;
            } elseif(pg_num_rows($result_name) > 0){
                $_SESSION['error_message'] = 'name_exists';
                header('Location:user.php');
                pg_free_result($result_name);
                exit;
            }
        }
    }

    if($isCompany){
        $iva_update = $_POST['iva_update'];
        $standardTax_update = $_POST['standardTax_update'];
        $weightTax_update = $_POST['weightTax_update'];
        $dimensionTax_update = $_POST['dimensionTax_update'];

        $query = 'UPDATE Corriere SET mail = $1, nome = $2, password_corriere = $3, indirizzo_fisico = $4, telefono = $5, partitaiva = $6, tariffa_peso = $7, tariffa_dimensioni = $8, tariffa_base = $9 WHERE mail = $10';
        $result = @pg_query_params($dbconn, $query, array($mail_update, strtoupper($name_update), $hashed_password, $address_update, $cellphone_update, $iva_update, $weightTax_update, $dimensionTax_update, $standardTax_update, $saved_mail));
    } else{
        $surname_update = $_POST['surname_update'];

        $query = 'UPDATE Utente SET mail = $1, nome = $2, cognome = $3, indirizzo_ritiro = $4, cellulare = $5, password_utente = $6 WHERE mail = $7';
        $result = @pg_query_params($dbconn, $query, array($mail_update, $name_update, $surname_update, $address_update, $cellphone_update, $hashed_password, $saved_mail));
    }

    if($result){
        if($isCompany){
            $_SESSION['isCompany'] = $isCompany;
            $_SESSION['nome_azienda'] = strtoupper($name_update);
            $_SESSION['iva'] = $iva_update;
            $_SESSION['tariffa_base'] = $standardTax_update;
            $_SESSION['tariffa_dimensioni'] = $dimensionTax_update;
            $_SESSION['tariffa_peso'] = $weightTax_update;
        } else {
            $_SESSION['nome'] = $name_update;
            $_SESSION['cognome'] = $surname_update;
        }
        $_SESSION['indirizzo'] = $address_update;
        $_SESSION['cellulare'] = $cellphone_update;
        $_SESSION['password'] = $psw_update;
        $_SESSION['user'] = $mail_update;
    header("Location: user.php");
    pg_free_result($result);

    pg_close($dbconn);
    exit;
    } else {
        header("Location: user.php");
        pg_close($dbconn);
        exit;        
    }
?>