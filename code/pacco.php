<?php
    session_start();

    require_once 'set_db.php';
    
    $dbconn = pg_connect($connection_string)
        or die('Could not connect: ' . pg_last_error());


?>