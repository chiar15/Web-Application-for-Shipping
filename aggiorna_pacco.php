<?php

    include_once "set_db.php";

    $dbconn = pg_connect($connection_string) or die('Could not connect: ' . pg_last_error());

    if(isset($_POST['nuovo_stato']) && isset($_POST['id_pacco'])){
        $nuovoStato = $_POST['nuovo_stato'];
    $idPacco = $_POST['id_pacco'];

    $query = "UPDATE Pacco SET stato = $1 WHERE id_pacco = $2";
    $result = @pg_query_params($dbconn, $query, array($nuovoStato, $idPacco));

    // Fallimento query
    if(!$result) {
        header("Location: index.php");
        pg_close($dbconn);
        exit;
    }

    pg_free_result($result);

    pg_close($dbconn);

    header("Location: tracking.php");
    } else {
        header("Location: index.php");
        pg_close($dbconn);
        exit;
    }
?>


