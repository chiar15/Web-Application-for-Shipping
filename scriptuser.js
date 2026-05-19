function editProfile() {
    // prevent form submission
    event.preventDefault();

    const fields = document.querySelectorAll("input");  // select all input fields
    const editButton = document.getElementById("editButton");  // select the edit button
    const passwordField = document.getElementById("password");  // select the password field
    const submitButton = document.getElementById("submitButton");

    // loop through all input fields
    
        for(let i = 0; i < fields.length; i++) {
            fields[i].removeAttribute("readonly");
            fields[i].style = "background-color: #FFDAB9";
        } 
        passwordField.type = "text";

        editButton.style.display = 'none';
        submitButton.style.display = 'flex';
        submitButton.style.backgroundColor = 'orange';
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


function validation(input){
    let ivaError = document.getElementById("iva_error");
    if(input.name_update.value == ""){
        input.name_update.focus();
        return false;
    }
    if(input.surname_update.value == ""){
        input.surname_update.focus();
        return false;
    }
    if(input.iva_update.value == ""){
        input.iva_update.focus();
    }
    if(input.address_update.value == ""){
        input.address_update.focus();
    }
    if(input.cellphone_update.value == ""){
        input.cellphone_update.focus();
    }
    if(input.standardTax_update.value == ""){
        input.standardTax_update.focus();
    }
    if(input.dimensionTax_update.value == ""){
        input.dimensionTax_update.focus();
    }
    if(input.weightTax_update.value == ""){
        input.weightTax_update.focus();
    }
    if(input.mail_update.value == ""){
        input.mail_update.focus();
    }
    if(input.psw_update.value == ""){
        input.psw_update.focus();
    }
    if(input.iva_update.value.length != 11){
        input.iva_update.focus();
        ivaError.style.display = 'flex';
        return false;
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

document.getElementById('iva').addEventListener('wheel', function(e) {
    e.preventDefault();
});

document.getElementById('tariffa_base').addEventListener('wheel', function(e) {
    e.preventDefault();
});
document.getElementById('tariffa_dimensioni').addEventListener('wheel', function(e) {
    e.preventDefault();
});
document.getElementById('tariffa').addEventListener('wheel', function(e) {
    e.preventDefault();
});

