let signup = document.querySelector(".signup");
let login = document.querySelector(".login");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");
let isCompanyCheckbox = document.querySelector(".company-checkbox");
let vatNumberInput = document.querySelector(".vat-number");
let companyNameInput = document.querySelector(".company-name");
let weightTaxInput = document.getElementById("weightTax");
let standardTaxInput = document.getElementById("standardTax");
let dimensionTaxInput = document.getElementById("dimensionTax");
let nameInput = document.getElementById("nome");
let surnameInput = document.getElementById("cognome");
let pswError = document.getElementById("psw_error");
let ivaError = document.getElementById("iva_error");

// Seleziona le due box
let loginBox = document.querySelector(".login-box");
let signupBox = document.querySelector(".signup-box");

// Seleziona i campi di input password e il pulsante di invio
let passwordInput = document.getElementById("conf_password");
let passwordConfirmInput = document.getElementById("conf2_password");

signup.addEventListener("click", () => {
    slider.classList.add("moveslider");
    // Quando si fa clic su "Signup", nascondi la loginBox e mostra la signupBox
    loginBox.style.display = "none";
    signupBox.style.display = "flex";
});

login.addEventListener("click", () => {
    slider.classList.remove("moveslider");
    // Quando si fa clic su "Login", nascondi la signupBox e mostra la loginBox
    signupBox.style.display = "none";
    loginBox.style.display = "flex";
});

isCompanyCheckbox.addEventListener("change", () => {
    if(isCompanyCheckbox.checked) {
        vatNumberInput.style.display = "block";
        vatNumberInput.required=true
        companyNameInput.style.display = "block";
        companyNameInput.required=true
        nameInput.style.display = "none";
        nameInput.required=false
        surnameInput.style.display = "none";
        surnameInput.required=false
        dimensionTaxInput.style.display = "block"
        dimensionTaxInput.required=true
        weightTaxInput.style.display = "block"
        weightTaxInput.required=true
        standardTaxInput.style.display = "block"
        standardTaxInput.required=true

    } else {
        vatNumberInput.style.display = "none";
        vatNumberInput.required=false
        companyNameInput.style.display = "none";
        companyNameInput.required=false
        nameInput.style.display = "block";
        nameInput.required=true
        surnameInput.style.display = "block";
        surnameInput.required=true
        dimensionTaxInput.style.display = "none"
        dimensionTaxInput.required=false
        weightTaxInput.style.display = "none"
        weightTaxInput.required=false
        standardTaxInput.style.display = "none"
        standardTaxInput.required=false
    }
});

function validationLogin(input){
    if(input.mail_login.value == ""){
        mail_login.focus();
        return false;
    }
    if(input.password_login.value == ""){
        password_login.focus();
        return false;
    }
}

function validationSignup(input){
    if(input.nome_azienda.required == true && input.nome_azienda.value == ""){
        input.nome_azienda.focus();
        return false;
    }
    if(input.iva.required == true && input.iva.value == ""){
        input.iva.focus();
        return false;
    }
    if(input.nome.required == true && input.nome.value == ""){
        input.nome.focus();
        return false;
    }
    if(input.cognome.required == true && input.cognome.value == ""){
        input.cognome.focus();
        return false;
    }
    if(input.cellulare.value == ""){
        input.cellulare.focus();
        return false;
    }
    if(input.indirizzo.value == ""){
        input.indirizzo.focus();
        return false;
    }
    if(input.mail.value == ""){
        input.mail.focus();
        return false;
    }
    if(input.conf_password.value == ""){
        input.conf_password.focus();
        return false;
    }
    if(input.conf2_password.value == ""){
        input.conf2_password.focus();
        return false;
    }
    if(input.iva.required && input.iva.value.length != 11){
        input.iva.focus();
        ivaError.style.display = 'flex';
        return false;
    }
    if(input.conf_password.value != input.conf2_password.value){
        conf_password.focus();
        conf_password.value = "";
        conf2_password.value = "";
        pswError.style.display = 'flex';
        return false;
    }

}

function soloNumeri(event){
    var tasto;
    tasto = event.key;
    // verifica tasti particolari tipo canc, invio, ...
    if ((tasto=="Delete") || (tasto=="Enter") || (tasto=="Backspace")){ 
        return true;
    } else if ((("0123456789").indexOf(tasto) > -1)) { 
        return true;
    } else {
    return false; }
}

function numberTax(event){
    var tasto;
    tasto = event.key;
    // verifica tasti particolari tipo canc, invio, ...
    if ((tasto=="Delete") || (tasto=="Enter") || (tasto=="Backspace")){ 
        return true;
    } else if (((".,0123456789").indexOf(tasto) > -1)) { 
        return true;
    } else {
    return false; }
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

document.getElementById('weightTax').addEventListener('wheel', function(e) {
    e.preventDefault();
});

document.getElementById('dimensionTax').addEventListener('wheel', function(e) {
    e.preventDefault();
});

document.getElementById('standardTax').addEventListener('wheel', function(e) {
    e.preventDefault();
});


document.getElementById('iva').addEventListener('wheel', function(e) {
    e.preventDefault();
});