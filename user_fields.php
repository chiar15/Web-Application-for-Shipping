<?php
    if(!isset($_SESSION['isCompany'])){
            if((isset($_SESSION['user']) && isset($_SESSION['nome']) && isset($_SESSION['cognome']) && isset($_SESSION['indirizzo']) && isset($_SESSION['cellulare']) && isset($_SESSION['password']))){
                $mail = $_SESSION['user'];
                $name = $_SESSION['nome'];
                $surname = $_SESSION['cognome'];
                $address = $_SESSION['indirizzo'];
                $cellphone = $_SESSION['cellulare'];
                $password = $_SESSION['password'];
                echo "<div>
                <div>
                <form action='update_user.php' method='POST' class='container' id='menu'>
                <h2>Welcome Back, $name!</h2>
                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/profilo-user.png'>
                </div>
                <div class='coppia-user'>
                    <p id='sec'><label for='nome'><b>Name</b></label><input value='$name' onkeydown='return checkProfile(event)' type='text' id='nome' name='name_update' autocomplete='off' readonly required></p>
                    <p id='sec'><label for='cognome'><b>Surname</b></label><input value='$surname' onkeydown='return checkProfile(event)' type='text' id='cognome' name='surname_update' autocomplete='off' readonly required></p>
                </div>
                <div class='coppia-user'>
                    <p id='sec'><label for='indirizzo'><b>Collection Address</b></label><input value='$address' type='text' id='indirizzo' name='address_update' autocomplete='off' readonly required></p>
                    <p id='sec'><label for='cellulare'><b>Phone Number<b></b></label><input value='$cellphone' type='text' id='cellulare' name='cellphone_update' autocomplete='off' onkeydown='return checkTelefono(event)' readonly required></p>
                </div>
                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/mail-user.png'>
                </div>
                <p class='single-p'><label for='mail'><b>Mail</b></label><input type='mail' id='mail' name='mail_update' value='$mail' readonly required></p>";
                if (isset($_SESSION['error_message'])) {
                    $error = $_SESSION['error_message'];
                    if ($error === 'email_exists'){
                        echo "<p style='color: red; font-size: 1rem; width: 95%; justify-content:flex-end;'>Mail già esistente!</p>";
                        unset($_SESSION['error_message']);
                        unset($error);
                    }
                }
echo"                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/psw-user.png'>
                </div>
                <p class='single-p'><label for='password'><b> Password </b></label><input value='$password' id='password' name='psw_update' type='password' id='nome' autocomplete='off' readonly required></p>
                <div id='error'>
                </div>
                        <div class='modifica'>   
                        <button id='editButton' type='button' class='bottone' onclick='editProfile()'>Editing</button>              
                    <input id='submitButton' type='submit' class='bottone' value='Confirm' style='display: none;'></input>
                </div>
            </form>
            </div>
            </div>";
            }
        }else {
            if((isset($_SESSION['user']) && isset($_SESSION['nome_azienda']) && isset($_SESSION['iva']) && isset($_SESSION['tariffa_base']) && isset($_SESSION['tariffa_dimensioni']) && isset($_SESSION['tariffa_peso']) && isset($_SESSION['indirizzo']) && isset($_SESSION['cellulare']) && isset($_SESSION['password']))){
                $mail = $_SESSION['user'];
                $name = $_SESSION['nome_azienda'];
                $iva = $_SESSION['iva'];
                $address = $_SESSION['indirizzo'];
                $cellphone = $_SESSION['cellulare'];
                $password = $_SESSION['password'];
                $weightTax = $_SESSION['tariffa_peso'];
                $standardTax = $_SESSION['tariffa_base'];
                $dimensionTax = $_SESSION['tariffa_dimensioni'];
                echo "<div>
                <div>
                <form onSubmit='return validation(this)' action='update_user.php' method='POST' class='container' id='menu'>
                <h2>Welcome Back, $name!</h2>
                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/profilo-user.png'>
                </div>
                <div class='coppia-user'>
                    <p id='sec'><label for='nome'><b>Name</b></label><input value='$name' type='text' id='nome' name='name_update' autocomplete='off' readonly required></p>
                    <p id='sec'><label for='iva'><b>Vat Number</b></label><input value='$iva' type='text' id='iva' name='iva_update' autocomplete='off' onkeydown='return soloNumeri(event)' onchange='verificaIva(this)' readonly required></p>
                </div>";
                if (isset($_SESSION['error_message'])) {
                    $error = $_SESSION['error_message'];
                    if ($error === 'name_exists'){
                        echo "<p style='color: red; font-size: 1rem; width: 95%; justify-content:flex-start; margin-bottom: 2%'>Already existing company!</p>";
                        unset($_SESSION['error_message']);
                        unset($error);
                    }
                }
echo"                <p id='iva_error' style='color: red; font-size: 1rem; width: 95%; display: none; justify-content:flex-end;'>L'IVA deve essere di 11 numeri!</p>
                <div class='coppia-user'>
                    <p id='sec'><label for='indirizzo'><b>Address</b></label><input value='$address' type='text' id='indirizzo' name='address_update' autocomplete='off' readonly required></p>
                    <p id='sec'><label for='cellulare'><b>Phone Number<b></b></label><input value='$cellphone' type='text' id='cellulare' name='cellphone_update' autocomplete='off' onkeydown='return checkTelefono(event)' readonly required></p>
                </div>
                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/ship-user.png'>
                </div>
                <div class='coppia-user'>
                    <p id='sec'><label for='tariffa_base'><b>Standard Tax</b></label><input min='0.01' value='$standardTax' type='number' id='tariffa_base' name='standardTax_update' autocomplete='off' onkeydown='return numerTax(event)' readonly required></p>
                    <p id='sec'><label for='tariffa_dimensioni'><b>Dimension Tax<b></b></label><input min='0.01' value='$dimensionTax' type='number' name='dimensionTax_update' id='tariffa_dimensioni' autocomplete='off' onkeydown='return numberTax(event)' readonly required></p>
                </div>
                <p class='single-p'><label for='tariffa'><b>Weight Tax</b></label><input min='0.01' value='$weightTax' type='number' name='weightTax_update' id='tariffa' onkeydown='return numberTax(event)' readonly required></p>
    
                <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/mail-user.png'>
                </div>
                <p class='single-p'><label for='mail'><b>Mail</b></label><input value='$mail' type='mail' name='mail_update' id='mail' readonly required></p>";
                if (isset($_SESSION['error_message'])) {
                    $error = $_SESSION['error_message'];
                    if ($error === 'email_exists'){
                        echo "<p style='color: red; font-size: 1rem; width: 95%; padding-top:1%; margin-left: 1%'>Already existing mail!</p>";
                        unset($_SESSION['error_message']);
                        unset($error);
                    }
                }
echo"           <div class='user-flex'>
                    <hr>
                    <img id='sec-img' src='imgs/psw-user.png'>
                </div>
                <p class='single-p'><label for='password'><b> Password </b></label><input value='$password' name='psw_update' id='password' type='password' id='nome' autocomplete='off' readonly required></p>
                <div id='error'
                </div>
                        <div class='modifica'>   
                        <button id='editButton' type='button' class='bottone' onclick='editProfile()'>Editing</button>              
                    <input id='submitButton' type='submit' class='bottone' value='Confirm' style='display: none;'></input>
                </div>
            </form>
            </div>
            </div>";
        }
        }
?>