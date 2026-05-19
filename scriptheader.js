let dropdown = document.getElementById("myDropdown");
let logo = document.getElementById("logo");
let logo_img = document.getElementById("logo-id");
let logo_hover = document.getElementById("logo-hover");

function toggleMenu(){
    dropdown.classList.toggle("show");
}

window.onclick = function(event) {
    if (!dropdown.contains(event.target) && !event.target.matches('.user_btn') && !event.target.matches('.user_btn img')) {
        // Il codice qui dentro verrà eseguito se l'utente ha cliccato su un elemento
        // che non è il pulsante utente, l'immagine del pulsante utente, o un elemento all'interno del contenuto a discesa
        dropdown.classList.remove('show'); // Nasconde il menu a discesa
    }
}

var dropdownLinks = dropdown.getElementsByClassName('menu_link');
for (var i = 0; i < dropdownLinks.length; i++) {
    dropdownLinks[i].addEventListener('click', function() {
        // Nasconde il menu a discesa quando viene cliccato un link
            dropdown.classList.remove('show');
    });
}

logo_img.addEventListener('mouseenter', () => {
    logo_img.style.display = 'none';
    logo_hover.style.display = 'block';
});

logo_hover.addEventListener('mouseleave', () => {
    logo_img.style.display = 'block';
    logo_hover.style.display = 'none';
})

