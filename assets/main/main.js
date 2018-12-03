// Función visual de la vista de registro
// Al hacer click en trabajador o empresario, el contenedor con la opción elegida se agranda y el otro se reduce.
function switchRegOpt(chosen) {
    switch (chosen) {
        case 'trabajador':
        hidden = 'empresario';
        break;
        case 'empresario':
        hidden = 'trabajador';
        break;
    }
    chosenID = document.getElementById('reg_opt_' + chosen);
    chosenText = document.getElementById('reg_opt_' + chosen + '_text');
    hiddenID = document.getElementById('reg_opt_' + hidden);
    hiddenText = document.getElementById('reg_opt_' + hidden + '_text');
    chosenForm = document.getElementById("reg_opt_" + chosen + "_form");
    hiddenForm = document.getElementById("reg_opt_" + hidden + "_form");
    
    hiddenText.style.opacity = 0;
    chosenID.style.width = "85%";
    hiddenID.style.width = "15%";

    // El formulario seleccionado aparece después de las animaciones (0.5s). El otro se oculta inmediatamente
    // Lo mismo para el texto "Soy X busco Y"
    hiddenForm.style.display = "none";
    setTimeout(() => {
        chosenText.style.opacity = 1;
        chosenForm.style.display = "flex";
        chosenForm.style.flexFlow = "row wrap";
        chosenForm.style.justifyContent = "space-between";
        chosenForm.style.maxWidth = "80%";
        chosenForm.style.margin = "0 auto";
    }, 500);
}

// Mostrar la contraseña en el formulario de registro
function showPass(pass) {
    passField = document.getElementById(pass);
    passField.type === "password" ? passField.type = "text" : passField.type = "password";
}

function search(base_url) {
    search_textbox = document.getElementById('search_textbox');
    query = search_textbox.value;
    fullQuery = base_url + "search/" + query;
    window.location.replace(fullQuery);
    search_textbox.value = query;
}