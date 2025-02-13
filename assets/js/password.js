function passwordstrong() {
    let recup_password = document.querySelector("#passtrong").value;
    let pass_length = recup_password.length;
    let progressbar = document.querySelector("#progressbar");

    let numUpper = recup_password.length - recup_password.replace(/[A-Z]/g, '').length;
    let nombre = recup_password.length - recup_password.replace(/[0-9]/g, '').length;
    let passwordcaractere = /[!@#\$%\^&\*\(\)\{\}\[\]:;"'<>\?\/\\|+=._~-]/.test(recup_password);

    let strength = 0;
    progressbar.style.width = strength + "%";

    if (pass_length >= 8) {
        strength += 43;
        progressbar.style.width = strength + "%"; 
    }

    if (numUpper > 0) {
        strength += 25; 
        progressbar.style.width = strength + "%"; 
    }

    if (nombre > 0) {
        strength += 15;
        progressbar.style.width = strength + "%";  
    }

    if (passwordcaractere) {
        strength += 15;
        progressbar.style.width = strength + "%";  
    }


    if (strength < 50) {
        progressbar.style.background = "red";
    } else if (strength < 75) {
        progressbar.style.background = "orange";
    } else{
        progressbar.style.background = "green";
        progressbar = strength + "%";  
    }
}
