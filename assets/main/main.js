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

    chosenText.style.opacity = 1;
    hiddenText.style.opacity = 0;
    chosenID.style.width = "85%";
    hiddenID.style.width = "15%";
    chosenForm.style.display = "initial";
    hiddenForm.style.display = "none";
}