function disableFather(checkBox) {
    let father_name = document.getElementById("father_name");
    let label = document.querySelector("[for='father_name']");

    if (checkBox.checked) {
        father_name.readOnly = true;
        father_name.value = "";
        father_name.classList.remove('required');
        label.innerHTML = "Nome do Pai";
    } else {
        father_name.readOnly = false;
        label.innerHTML = "Nome do Pai *";
        father_name.classList.add('required');
    }
}
