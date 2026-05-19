<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styleheader.css">
</head>
<header>
    <div class="navbar">
        <a id="logo" class="logo" href="index.php"><img id="logo-id" src="imgs/logo.png"><img id="logo-hover" src="imgs/logo_hover.png"></a>
        <a id="monitoring" class="nav_link" href="tracking.php">Tracking</a>
        <a id="booking" class="nav_link" href="prenotazione.php">Booking</a>
        <div class="menu">
        <button id="login_btn" class="login_btn" onclick="document.location='auth.php'">Login</button>
        <button id="user_btn" class="user_btn" onclick="toggleMenu()"><img src="imgs/user.png"></button>
        <div id="myDropdown" class="dropdown_content">
            <ul>
                <li><div class="user_info"><img src="imgs/user.png"><h3 id="user_mail"style="color:black">Nome Cognome</h3></div></li>
                <li><hr></li>
                <li><a class="menu_link" href="user.php"><div class="wrap"><img src="imgs/profile.png"><p>Profile</p></div></a></li>
                <li><a class="menu_link" href="logout.php"><div class="wrap"><img src="imgs/logout.png"><p>Logout</p></div></a></li>
            </ul>
        </div>
        </div>
        <?php
            if(isset($_SESSION['user'])){
                $user = $_SESSION['user'];
                if(isset($_SESSION['isCompany'])){
                    $company = $_SESSION['isCompany'];
                    echo "<script>
                        let booking = document.getElementById('booking');
                        let monitoring = document.getElementById('monitoring');

                        monitoring.style.fontSize = '3.5vh';
                        booking.style.display = 'none';

                    </script>";
                }
                echo "<script>
                    let login = document.getElementById('login_btn');
                    let user = document.getElementById('user_btn');
                    let name = document.getElementById('user_mail');

                    login.style.display = 'none';
                    user.style.display = 'block';
                    name.innerHTML = '$user';

                </script>";
            }
        ?>
        
    </div>
    <script type="text/javascript" src="scriptheader.js"></script>
</header>

