<?php
    session_start();
    if (isset($_SESSION['isCompany'])) {
        header("Location: index.php");
        exit;
    }

    include_once 'corriere.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione</title>
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

/* passa il mouse sopra al testo cambia il colore in arancione*/
a:hover {
    color: orange;
}

/*contenitore delle cards*/
.container {
    align-items: center;
    justify-content: center;
    width: 100%;
    padding-bottom: 2%;
    height: fit-content;
    display: flex;
    justify-items: center;
}

h1 {
    padding-left: 2%;
}

/*stile per le card verticali*/
.card-verticale {
    width: 42%;
    height: fit-content;
    border-radius: 20px;
    background-color: white;
    padding: 2% 2%;
    margin: 3rem 1.5rem;
    box-shadow: 8px 8px 20px rgb(128, 128, 128);
}

/*stile per le card orizzontali*/
.card-orizzontale {
    width: 90%;
    height: fit-content;
    border-radius: 20px;
    background-color: white;
    padding: 5% 5%;
    margin: 0 auto;
    margin-bottom: 3rem;
    box-shadow: 8px 8px 20px rgb(128, 128, 128);
}

/*usata nel card orizzonatli per mettere due o tre input sulla stessa linea*/
.coppia-parcel {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;
}

/*stile per i campi di input e per il chooser*/
select,
input {
    height: 60px;
    width: 100%;
    outline: none;
    border: none;
    color: rgb(77, 77, 77);
    background-color: rgb(240, 240, 240);
    border-radius: 50px;
    padding-left: 30px;
    font-size: 16px;
    margin: 1.5rem 0.5rem;
}

/*contenitore per il chooser*/
fieldset {
    border: none;
    outline: none;
    display: flex;
    align-items: center;
    justify-items: center;
    width: 100%;
    height: 60px;
}

/*stile dei paragrafi*/
p {
    width: 100%;
    display: flex;
    align-items: center;
}

/*impostazioni dello stile per l'input type number*/
#number {
    width: 20%;
    border: black;
    outline: none;
}

.coppia-parcel {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;
}

.pacco-delete {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: space-between;
}


/*stile per il bottone di conferma*/
.formButton {
    background-color: orange;
    color: white;
    border-radius: 20px;
    text-align: center;
    padding: 2% 2%;
    height: fit-content;
    width: fit-content;
    border: none;
    outline: none;
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
    justify-content: center;
}

.add-confirm-div {
    display: flex;
    justify-content: space-around;
}

.name-delete-div {
    display: flex;
    justify-content: flex-start;
}

.single-elem-div {
    display: flex;
    justify-content: center;
}

/*usato per contenere le cards che vengono create quando si aggiungono altri pacchi*/
#cards-container {
    align-items: center;
    justify-content: center;
    display: block;
    width: 100%;
    height: fit-content;
    margin: 0 auto;
}

#note-speciali {
    height: 10rem;
}

textarea {
    height: 45vh;
    width: 100%;
    resize: none;
    outline: none;
    border: none;
    color: rgb(77, 77, 77);
    background-color: rgb(240, 240, 240);
    border-radius: 50px;
    padding: 5%;
    font-size: 16px;
    margin: 1.5rem 0.5rem;
}

#calcola {
    cursor: pointer;
    opacity: 1;
}

#calcola:disabled  {
    opacity: 0.5;
    cursor: default;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

#phone_error {
    color: red;
    font-size: 1rem;
    display: none;
}
    </style>
</head>

<body>
<?php include_once 'header.php';?>
    <form onSubmit="return validationBooking();" action="salva_pacco.php" method='POST'>
        <div class="container">

        <div class="card-verticale">

        <h1>Addressee</h1>
        <p><input id="nome" name='nome_destinatario' type="text" placeholder="Addressee Name *" required onkeydown="return checkProfile(event)"></p>
        <p><input id="cognome" name='cognome_destinatario'type="text" placeholder="Addressee Surname *" required onkeydown="return checkProfile(event)"></p>
        <p><input id="indirizzo_ritiro" name='indirizzo_destinatario' type="text" placeholder="Addressee Address *" required></p>
        <p><input type="text" id="cellulare" name='cellulare_destinatario' placeholder="Addressee Phone Number *" onkeydown="return checkTelefono(event)" required></p>
        <p id="phone_error">Invalid phone number!</p>

        </div>

            <div class="card-verticale">
            <fieldset>
                <p><select name="corriere" id="corriere" onchange="updateTariff()">
                    <?php
                        foreach($corrieri as $corriere){
                            echo "<option value='{$corriere['nome']}'>{$corriere['nome']}</option>";
                        }
                    ?>
                </select></p>
            </fieldset> 
            <br>
            <br>
            <hr>
            <br>
            <br>

            <div id="tariff-details" style="font-size: 1.2rem"></div>

            <br>
            <br>
            <hr>
            <br>
            <br>

            <div id="price-details" style="font-size: 1.2rem"></div>

            </div>


        </div>

        <div class="container" id="cards-container">
            <div id="parcels-container">
                <div class="card-orizzontale" id="card">
                    <h1>Compile your parcel!</h1>
                    <div class="coppia-parcel">
                        <p><input type="number" min="0.01" step="0.01" id="peso" name='peso' type="text" placeholder="Weight (Kg) *" onkeydown="numberDimension()" required></p>
                        <p><input type="number" min="0.01" step="0.01" id="altezza" name='altezza' type="text" placeholder="Height (cm) *" onkeydown="numberDimension()" required></p>
                    </div>
                    <div class="coppia-parcel">
                        <p><input type="number" min="0.01" step="0.01" id="larghezza" name='larghezza' type="text" placeholder="Width (cm) *" onkeydown="numberDimension()" required>
                        </p>
                        <p><input type="number" min="0.01" step="0.01" id="spessore" name='spessore' type="text" placeholder="Depth (cm) *" onkeydown="numberDimension()" required>
                        </p>
                    </div>
                    <div class="single-elem-div">
                        <button class="formButton" type='button' onclick="calcolaPrezzo()" id="calcola" disabled>Compute</button>
                    </div>
                    <div class="single-elem-div">
                        <textarea maxlength="1000" resize="none" rows="5" cols="60" name="note" placeholder="Optional notes for the delivery (max. 1000 characters)"></textarea>
                    </div>
                            
                </div>
            </div>

            <div class="add-confirm-div" id='buttonsDiv'>
                <button class="formButton" type="submit" id="confirmButton">Confirm</button>
            </div>
        </div>
    </form>

    <script>
    
    const corrieri = <?php echo $json_corrieri; ?>;

    function updateTariff() {

        const selectedCourier = document.getElementById('corriere').value;
        const courier = corrieri.find(c => c.nome === selectedCourier);
        const tariffDetails = `<b>You have just selected <span style="color:orange">${courier.nome}</span>, with weigth tax of <span style="color:orange">${courier.tariffa_peso}€</span>, dimension tax of <span style="color:orange">${courier.tariffa_dimensioni}€</span> and standard tax of <span style="color:orange">${courier.tariffa_base}€</span>.</b>`;
        document.getElementById('tariff-details').innerHTML= tariffDetails;
        document.getElementById('price-details').innerHTML = `<b>Use the button in the parcel card to compute the total amount you would pay to <span style="color:orange">${courier.nome}</span>!</b>`;
    }

    // Initialize tariff details
    updateTariff();
    
    // Listener della card
    const peso = (document.getElementById('peso'));
    const altezza = (document.getElementById('altezza'));
    const larghezza = (document.getElementById('larghezza'));
    const spessore = (document.getElementById('spessore'));
    const btn = (document.getElementById('calcola'));
    phone_error = (document.getElementById('phone_error'));

    peso.addEventListener('input', disableBtn);
    altezza.addEventListener('input', disableBtn);
    larghezza.addEventListener('input', disableBtn);
    spessore.addEventListener('input', disableBtn);

    function disableBtn(){
        if(peso.value && altezza.value && larghezza.value && spessore.value){
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }

    function numberDimension(event){
    var tasto;
    tasto = event.key;
    // verifica tasti particolari tipo canc, invio, ...
        if ((tasto=="Delete") || (tasto=="Enter") || (tasto=="Backspace")){ 
            return true;
        } else if (((".,0123456789").indexOf(tasto) > -1)) { 
            return true;
        } else {
            return false; 
        }
    }



    function checkTelefono(event) {
    var tasto;
    tasto = event.key;
    var input = event.target.value;
    var cursorPosition = event.target.selectionStart;

        if((tasto === 'Delete') || (tasto === 'Enter') || (tasto === 'Backspace')){
            return true;
        } else if (cursorPosition === 0 && !input.includes('+')){
            return (tasto === '+' || (tasto >= "0" && tasto <= "9"));
        } else {
            return (tasto >= "0" && tasto <= "9");
        }
    }

    function checkProfile(event) {
    var tasto = event.key;
    // Verifica tasti particolari tipo canc, invio, ...
    if ((tasto == "Delete") || (tasto == "Enter") || (tasto == "Backspace") || (tasto == " ")) {
        return true;
    } else if ((/[A-Za-zÀ-ÿ]/.test(tasto))) {
        return true;
    } else {
        return false;
    }
}

    function calcolaPrezzo(){
        const selectedCourier = document.getElementById('corriere').value;
        const courier = corrieri.find(c => c.nome === selectedCourier);

        spessore_val = Number(spessore.value);
        larghezza_val = Number(larghezza.value);
        altezza_val = Number(altezza.value);
        peso_val = Number(peso.value);

        // Verifico se sono tutti numeri
            const costoDimensioni = (altezza_val * larghezza_val * spessore_val * Number(courier.tariffa_dimensioni) / 50);
            const costoPeso = (peso_val * Number(courier.tariffa_peso));
            const costoSpedizione = costoDimensioni + costoPeso + Number(courier.tariffa_base);
            const priceDetails = `<b>Based on the chosen company the total amount is: <span style="color:orange">${costoDimensioni}€</span> + <span style="color:orange">${costoPeso}€</span> + <span style="color:orange">${courier.tariffa_base}€</span> = <span style="color:orange">${costoSpedizione.toFixed(2)}€</span></b>`;
            document.getElementById('price-details').innerHTML = priceDetails;
    }

    peso.addEventListener('wheel', function(e) {
        e.preventDefault();
    });

    altezza.addEventListener('wheel', function(e) {
        e.preventDefault();
    });

    document.getElementById('cellulare').addEventListener('wheel', function(e) {
        e.preventDefault();
    });

    larghezza.addEventListener('wheel', function(e) {
        e.preventDefault();
    });

    spessore.addEventListener('wheel', function(e) {
        e.preventDefault();
    });

    function validationBooking(){
        pesoVal = peso.value;
        larghezzaVal = larghezza.value;
        spessoreVal = spessore.value;
        altezzaVal = altezza.value;
        cellulare=cellulare_destinario.value;

        if(nome_destinatario.value == ""){
            nome_destinario.focus();
            return false;
        }
        if(cognome_destinatario.value == ""){
            cognome_destinario.focus();
            return false;
        }
        if(indirizzo_destinatario.value == ""){
            indirizzo_destinario.focus();
            return false;
        }
        if(cellulare == ""){
            cellulare_destinario.focus();
            return false;
        }
        if(pesoVal == ""){
            peso.focus();
            return false;
        }
        if(altezzaVal == ""){
            peso.focus();
            return false;
        }
        if(larghezzaVal == ""){
            peso.focus();
            return false;
        }
        if(spessoreVal == ""){
            peso.focus();
            return false;
        }

    }

    function verificaNum(){
        cellulare = cellulare_destinario.value;
        if(cellulare.charAt(0) == "+"){
        if(cellulare.length != 13){
            phone_error.style.display = 'flex';
            cellulare_destinario.focus();
        } else {
            phone_error.style.display = 'none';
        }
    } else {
        if(cellulare.length != 10){
            phone_error.style.display = 'flex';
            cellulare_destinario.focus();
        } else {
            phone_error.style.display = 'none';
        }
    }

    }
</script>

    <?php include_once 'footer.html';?>   
</body>

</html>