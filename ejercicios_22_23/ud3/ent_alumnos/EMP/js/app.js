const comprobarPassw = () => {
    passw = document.getElementById('passw').value;
    passw2 = document.getElementById('passw2').value;
    let msg = '';
    if (passw != passw2) {
        msg = "Las contraseñas no coinciden";
        document.getElementById("registrarse").disabled = true;
    } else
        document.getElementById("registrarse").disabled = false;

    document.getElementById('passwNoValida').innerHTML = msg;
}

document.getElementById('passw').addEventListener("change", comprobarPassw);
document.getElementById('passw2').addEventListener("change", comprobarPassw);