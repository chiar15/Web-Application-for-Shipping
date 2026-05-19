<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: auth.php");
        exit;
    }
    include_once 'recupera_pacchi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            height: 100vh;
            background-color: black;
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            align-content: flex-start;
            gap: 7%;
            justify-content: flex-start;

        }

        .riga-tariffe {
            display: flex;
            justify-content: space-between;
            padding-bottom: 5%;
        }

        .riga-button {
            display: flex;
            justify-content: space-around;
            padding: 5% 0;
        } 

        .card {
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(128, 128, 128, 0.6);
            transition: 0.3s;
            width: 25vw;
            min-width: 20vw;
            border-radius: 5vh;
            padding: 2%;
            margin-top: 5%;
        }

        .card:hover {
            box-shadow: 0 4px 4px 4px rgba(128, 128, 128, 0.6);
        }

        .card-title {
            color: orange;
        }

        span {
            color: orange;
        }

        h1 {
            color: orange;
        }

        h2, h3, p {
            padding-bottom: 5%;
        }

        .section-container {
            padding: 2%;
            height: fit-content;
            display: flex;
            flex-direction: column;
        }

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            border-radius: 2vh;
        }

        .accettaBtn{
            background-color: white; 
            color: black; 
            border: 2px solid #4CAF50;
        }

        .accettaBtn:hover {
            background-color: #4CAF50;
            color: white;
        }

        .rifiutaBtn {
            background-color: white; 
            color: black; 
            border: 2px solid #f44336;
        }

        .rifiutaBtn:hover {
            background-color: #f44336;
            color: white;
        }

        .no-parcel-div {
            display: flex; 
            justify-content: center; 
            padding: 5% 0;
        }

        .no-parcel-card {
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(128, 128, 128, 0.6);
            transition: 0.3s;
            width: 30%;
            border-radius: 5vh;
            padding: 2%;
            margin-top: 5%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

    
    </style>
</head>
<body>
<?php
    include_once 'header.php';
?>
    <div class="section-container">
        <div>
            <h1> On road </h1>
        </div>
        <div class="card-container">
            <?php
                if (count($inTransito) == 0) {
                    echo "<div class='no-parcel-card'>";
                    echo "<div class='no-parcel-div'><img src='imgs/noParcel.png' alt='pkg' width='60%'></div>";
                    echo "<div class='no-parcel-div'><h2>No parcel here!</h2></div>";
                    echo "</div>";
                } else {
                    foreach ($inTransito as $pacco) {
                        echo '<div class="card">';
                        echo '<h2 class="card-title">Id #' .  $pacco['id_pacco'] . '</h2>';
                        
                        // Verifica se la sessione 'isCompany' è attiva
                        if (isset($_SESSION['isCompany'])) {
                            echo '<h3><b>From <span>' . $pacco['mail_utente'] . '</span></b></h3>';
                        } else {
                            echo '<h3><b>By <span>' . $pacco['nome_corriere'] . '</span></b></h3>';
                        }
                        
                        echo '<p><b>To</b> ' . $pacco['nome_destinatario'] . ' ' . $pacco['cognome_destinatario'] . ', ' . $pacco['indirizzo_destinatario'] . '</p>';
                        echo '<p><b>Amount paid:</b> ' . $pacco['prezzo'] . ' €</p>';
                        echo '<div class="riga-tariffe">';
                        echo '<div> <b>Height:</b> ' . $pacco['altezza'] . ' cm </div>';
                        echo '<div> <b>Weight:</b> ' . $pacco['peso'] . ' kg </div>';
                        echo '</div>';
                        echo '<div class="riga-tariffe">';
                        echo '<div> <b>Width:</b> ' . $pacco['spessore'] . ' cm </div>';
                        echo '<div> <b>Depth:</b> ' . $pacco['larghezza'] . ' cm </div>';
                        echo '</div>';
                        if (isset($pacco['note_speciali'])) {
                            echo '<p><b>Special notes:</b> ' . $pacco['note_speciali'] . '</p>';
                        } else {
                            echo '<b>No note!</b>';
                        }
    
                        
                        if (isset($_SESSION['isCompany'])) {
                            echo '<div class="riga-button">';
            
                            // Form per "Consegna"
                            echo '<form method="POST" action="aggiorna_pacco.php" style="display: inline;">';
                            echo '<input type="hidden" name="nuovo_stato" value="Consegnato"/>';
                            echo '<input type="hidden" name="id_pacco" value="'.$pacco['id_pacco'].'"/>';
                            echo '<input type="submit" class="button accettaBtn" value="Consegna"/>';
                            echo '</form>';
            
                            echo '</div>';
                        }
                        
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>

    <div class="section-container" id='inElaborazioneContainerId'>
        <div>
            <h1> Processing </h1>
        </div>
        <div class="card-container">
        <?php
            if (count($inElaborazione) == 0) {
                echo "<div class='no-parcel-card'>";
                echo "<div class='no-parcel-div'><img src='imgs/noParcel.png' alt='pkg' width='60%'></div>";
                echo "<div class='no-parcel-div'><h2>No parcel here!</h2></div>";
                echo "</div>";
            } else {
                foreach ($inElaborazione as $pacco) {
                    echo '<div class="card">';
                    echo '<h2 class="card-title">Id #' .  $pacco['id_pacco'] . '</h2>';
                    
                    // Verifica se la sessione 'isCompany' è attiva
                    if (isset($_SESSION['isCompany'])) {
                        echo '<h3><b>From <span>' . $pacco['mail_utente'] . '</span></b></h3>';
                    } else {
                        echo '<h3><b>By <span>' . $pacco['nome_corriere'] . '</span></b></h3>';
                    }
                    
                    echo '<p><b>To</b> ' . $pacco['nome_destinatario'] . ' ' . $pacco['cognome_destinatario'] . ', ' . $pacco['indirizzo_destinatario'] . '</p>';
                    echo '<p><b>Amount paid:</b> ' . $pacco['prezzo'] . ' €</p>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Height:</b> ' . $pacco['altezza'] . ' cm </div>';
                    echo '<div> <b>Weight:</b> ' . $pacco['peso'] . ' kg </div>';
                    echo '</div>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Width:</b> ' . $pacco['spessore'] . ' cm </div>';
                    echo '<div> <b>Depth:</b> ' . $pacco['larghezza'] . ' cm </div>';
                    echo '</div>';
                    if (isset($pacco['note_speciali'])) {
                        echo '<p><b>Special notes:</b> ' . $pacco['note_speciali'] . '</p>';
                    } else {
                        echo '<b>No note!</b>';
                    }

                    
                    if (isset($_SESSION['isCompany'])) {
                        echo '<div class="riga-button">';
        
                        // Form per "Accetta"
                        echo '<form method="POST" action="aggiorna_pacco.php" style="display: inline;">';
                        echo '<input type="hidden" name="nuovo_stato" value="In transito"/>';
                        echo '<input type="hidden" name="id_pacco" value="'.$pacco['id_pacco'].'"/>';
                        echo '<input type="submit" class="button accettaBtn" value="Accetta"/>';
                        echo '</form>';
        
                        // Form per "Rifiuta"
                        echo '<form method="POST" action="aggiorna_pacco.php" style="display: inline;">';
                        echo '<input type="hidden" name="nuovo_stato" value="Rifiutato"/>';
                        echo '<input type="hidden" name="id_pacco" value="'.$pacco['id_pacco'].'"/>';
                        echo '<input type="submit" class="button rifiutaBtn" value="Rifiuta"/>';
                        echo '</form>';
        
                        echo '</div>';
                    }
                    
                    echo '</div>';
                }
            }
            ?>

        </div>
    </div>

    <div class="section-container">
        <div>
            <h1> Rejected </h1>
        </div>
        <div class="card-container">
        <?php
            if (count($rifiutato) == 0) {
                echo "<div class='no-parcel-card'>";
                echo "<div class='no-parcel-div'><img src='imgs/noParcel.png' alt='pkg' width='60%'></div>";
                echo "<div class='no-parcel-div'><h2>No parcel here!</h2></div>";
                echo "</div>";
            } else {
                foreach ($rifiutato as $pacco) {
                    echo '<div class="card">';
                    echo '<h2 class="card-title">Id #' .  $pacco['id_pacco'] . '</h2>';
                    
                    // Verifica se la sessione 'isCompany' è attiva
                    if (isset($_SESSION['isCompany'])) {
                        echo '<h3><b>From <span>' . $pacco['mail_utente'] . '</span></b></h3>';
                    } else {
                        echo '<h3><b>By <span>' . $pacco['nome_corriere'] . '</span></b></h3>';
                    }
                    
                    echo '<p><b>To</b> ' . $pacco['nome_destinatario'] . ' ' . $pacco['cognome_destinatario'] . ', ' . $pacco['indirizzo_destinatario'] . '</p>';
                    echo '<p><b>Amount paid</b> ' . $pacco['prezzo'] . ' €</p>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Height:</b> ' . $pacco['altezza'] . ' cm </div>';
                    echo '<div> <b>Weight:</b> ' . $pacco['peso'] . ' kg </div>';
                    echo '</div>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Width:</b> ' . $pacco['spessore'] . ' cm </div>';
                    echo '<div> <b>Depth</b> ' . $pacco['larghezza'] . ' cm </div>';
                    echo '</div>';
                    if (isset($pacco['note_speciali'])) {
                        echo '<p><b>Special notes:</b> ' . $pacco['note_speciali'] . '</p>';
                    } else {
                        echo '<b>No note!</b>';
                    }

                    
                    echo '</div>';
                }
            }
        ?>
        </div>
    </div>

    <div class="section-container">
        <div>
            <h1> Delivered </h1>
        </div>
        <div class="card-container">
        <?php
            if (count($consegnato) == 0) {
                echo "<div class='no-parcel-card'>";
                echo "<div class='no-parcel-div'><img src='imgs/noParcel.png' alt='pkg' width='60%'></div>";
                echo "<div class='no-parcel-div'><h2>No parcel here!</h2></div>";
                echo "</div>";
            } else {
                foreach ($consegnato as $pacco) {
                    echo '<div class="card">';
                    echo '<h2 class="card-title">Id #' .  $pacco['id_pacco'] . '</h2>';
                    
                    // Verifica se la sessione 'isCompany' è attiva
                    if (isset($_SESSION['isCompany'])) {
                        echo '<h3><b>From <span>' . $pacco['mail_utente'] . '</span></b></h3>';
                    } else {
                        echo '<h3><b>By <span>' . $pacco['nome_corriere'] . '</span></b></h3>';
                    }
                    
                    echo '<p><b>To</b> ' . $pacco['nome_destinatario'] . ' ' . $pacco['cognome_destinatario'] . ', ' . $pacco['indirizzo_destinatario'] . '</p>';
                    echo '<p><b>Amount paid:</b> ' . $pacco['prezzo'] . ' €</p>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Height:</b> ' . $pacco['altezza'] . ' cm </div>';
                    echo '<div> <b>Weight:</b> ' . $pacco['peso'] . ' kg </div>';
                    echo '</div>';
                    echo '<div class="riga-tariffe">';
                    echo '<div> <b>Width:</b> ' . $pacco['spessore'] . ' cm </div>';
                    echo '<div> <b>Depth:</b> ' . $pacco['larghezza'] . ' cm </div>';
                    echo '</div>';
                    if (isset($pacco['note_speciali'])) {
                        echo '<p><b>Special notes:</b> ' . $pacco['note_speciali'] . '</p>';
                    } else {
                        echo '<b>No note!</b>';
                    }

                    
                    echo '</div>';
                }
            }
        ?>

        </div>
    </div>
    <div style="padding-bottom: 2%;"></div>
    <?php
    include_once 'footer.html';
?>
</body>
</html>