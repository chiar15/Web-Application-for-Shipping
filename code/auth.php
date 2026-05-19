<?php
session_start();  // Aggiungi questa linea qui
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="styleauth.css">
</head>

<body>
<?php include_once 'header.php';?>
    <div class="center-container">
        <div class="container">

            <div class="slider"></div>
            <div class="btn">
                <button class="login">Login</button>
                <button class="signup">Signup</button>
            </div>

            <div class="form-section">

                <form onSubmit="return validationLogin(this)" action="login.php" method="POST" class="login-box" id="login-box">
                    <input type="email" name="mail_login"
                        class="email ele"
                        placeholder="youremail@email.com" required>
                    
                    <input type="password" name="password_login"
                        class="password ele"
                        placeholder="Password" required>
                        <?php
                            if (isset($_SESSION['error_message'])) {
                                $error = $_SESSION['error_message'];
                                if ($error === 'wrong_psws') {
                                    echo "<p style='color: red; font-size: 1.5rem;'>Wrong password!</p>";
                                    unset($_SESSION['error_message']);
                                    unset($error);
                                }elseif ($error === 'user_not_found') {
                                    echo "<p style='color: red; font-size: 1.5rem;'>Wrong mail!</p>";
                                    unset($_SESSION['error_message']);
                                    unset($error);
                                }
                            }
                        ?>
                    <input type="submit" class="clkbtn" value="Login">
                </form>

                <!-- signup form -->
                <form onSubmit="return validationSignup(this)" action="signup.php" method="POST" class="signup-box" id="signup-box">
                <div class="chbx-azienda">
                        <input type="checkbox" id="isCompany" name="check" class="company-checkbox" >
                        <span class="link-space"></span>
                        <label for="isCompany" class="company-checkbox-label"><b>Company?</b></label>
                    </div>
                    <input type="text" id="companyName" name="nome_azienda"
                        class="company-name ele"
                        placeholder="Company name *" style="display: none;">
                        <?php
                        if (isset($_SESSION['error_message'])) {
                            $error = $_SESSION['error_message'];
                            if ($error === 'name_exists'){
                                echo "<p style='color: red; font-size: 1.5rem;'>Already existing company!</p>";
                                unset($_SESSION['error_message']);
                                unset($error);
                            }
                        }
                        ?>
                    <input type="text" id="vatNumber" name="iva"
                        class="vat-number ele"
                        placeholder="Company Vat Number *" onkeydown="return soloNumeri(event)" style="display: none;">
                        <p id="iva_error">Vat number must have 11 digits!</p>
                    <input type="text" name="nome" id="nome" onkeydown="return checkProfile(event)"
                        class="name ele"
                        placeholder="Name *" required>
                    <input type="text" name="cognome" id="cognome" onkeydown="return checkProfile(event)"
                        class="surname ele"
                        placeholder="Surname *" required>
                    <input type="text" name="cellulare"
                        class="cellphone ele"
                        placeholder="Phone number *" required onkeydown="return checkTelefono(event)">
                    <input type="text" name="indirizzo"
                        class="address ele"
                        placeholder="Address *" required>
                    <input type="number" id="weightTax" name="tariffa_peso"
                        class="weightTax ele" onkeydown="return numberTax()" step="0.01" min="0.01"
                        placeholder="Weight tax *" style="display: none;">
                    <input type="number" id="standardTax" name="tariffa_base"
                        class="standardTax ele" onkeydown="return numberTax()" step="0.01" min="0.01"
                        placeholder="Standard tax *" style="display: none;">
                    <input type="number" id="dimensionTax" name="tariffa_dimensioni"
                        class="dimensionTax ele" onkeydown="return numberTax()" step="0.01" min="0.01"
                        placeholder="Dimension tax *" style="display: none;">
                    <input type="email" name="mail"
                        class="email ele"
                        placeholder="youremail@email.com *">
                    <input type="password" id="conf_password"
                        class="conf_password ele" name="conf_password"
                        placeholder="Password *" required>
                    <input type="password" id="conf2_password"
                        class="conf_password ele" name="conf2_password"
                        placeholder="Confirm password *" required>
                    <p id="psw_error">Not matching password!</p>
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        $error = $_SESSION['error_message'];
                        if ($error === 'email_exists'){
                            echo "<p style='color: red; font-size: 1.5rem;'>Mail già esistente!</p>";
                            unset($_SESSION['error_message']);
                            unset($error);
                        }
                    }
                    ?>
                    <input id="clkbtn2" class="clkbtn" type="submit" value="Signup">
                </form>
            </div>
        </div>
    </div>
    <script src="scriptauth.js"></script>

    <?php include_once 'footer.html';?>
</body>
</html>