
const Loginbutton = document.querySelector('#loginbutton');
const Signupbutton = document.querySelector('#signupbutton');
const panels_container = document.querySelector('.container .panels-container');
const contanerpanel = document.querySelector('.container .panels-container .contanerpanel');
const btnon = document.querySelector('#btnon');
Loginbutton.addEventListener('click', () => {
    panels_container.style.transform = "translateX(100%)";
    contanerpanel.style.transform = "translateX(-50%)";
});
Signupbutton.addEventListener('click', () => {
    panels_container.style.transform = 'translateX(0)';
    contanerpanel.style.transform = "translateX(0)";
});
window.addEventListener('resize', () => {
    if (innerWidth < 600) {
        window.location.replace("login.php");
    }
});

function validatePwc() {
    var pwc = document.forms["fo"]["password2"];
    var pw = document.forms["fo"]["password1"];
    if (pwc.value != pw.value) {
        document.getElementById('errorname').innerHTML = "Mots de passe non identiques!<br/>";
        pwc.focus();
    }
    else {
        document.getElementById('errorname').innerHTML = "";
    }
}


function validatePw() {
    var pw = document.forms["fo"]["password1"];
    if (pw.value == "") {
        document.getElementById('errorpw').innerHTML = "Veuillez entrez un mot de passe <br />";
        pw.focus();
    }
    else
        document.getElementById('errorpw').innerHTML = "";
}
function effacer() {
    var pw = document.forms["fo"]["password1"];
    var pwc = document.forms["fo"]["password2"];
    var login = document.forms["fo"]["email1"];
    var prenom = document.forms["fo"]["lastname"];
    var nom = document.forms["fo"]["name"];
    var valider = document.forms["fo"]["submitsignup"];
    if (pw.value != pwc.value) {
        alert('les donner pw sont erroner !! :');
    }
    if (pw.value == "" || login.value == "" || prenom.value == "" || nom.value == "") {
        alert('veuillez saisir tout les donner :');
    }
}