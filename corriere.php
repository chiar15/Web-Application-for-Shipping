<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'set_db.php';

$dbconn = pg_connect($connection_string)
    or die('Could not connect: ' . pg_last_error());

$query = "SELECT nome, tariffa_peso, tariffa_dimensioni, tariffa_base FROM Corriere";
$result = @pg_query($dbconn, $query);

if(!$result){
    header('Location:prenotazione.php');
    pg_close($dbconn);
    exit;
}

$corrieri = array();

while($row=pg_fetch_assoc($result)){
    $corrieri[] = $row;
};

$json_corrieri = json_encode($corrieri);

pg_free_result($result);
pg_close($dbconn);
?>