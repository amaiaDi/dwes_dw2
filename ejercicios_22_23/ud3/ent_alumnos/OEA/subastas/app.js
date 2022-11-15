window.onload
{
    Array.from(document.getElementsByTagName('input')).forEach(function(element) {element.addEventListener('blur', comprobar)});
}
function comprobar(){
    let id = this.id;
    let value = this.value;
    if(value == "")
        return;
    let nombre = new RegExp(/^[a-zA-Z ]{0,100}$/);
    let usuario = new RegExp(/^[a-zA-Z \d]{1,40}$/);
    let email = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    switch (id) {
        case 'usuario':
            if (!usuario.test(value)){
                alert("Usuario Incorrecto");
                document.getElementById(id).value = "";
            }
            break;
        case 'nombre':
            if (!nombre.test(value)){
                alert("Nombre Incorrecto");
                document.getElementById(id).value = "";
            }
            break;
        case 'email':
            if (!email.test(value)){
                alert("Email Incorrecto");
                document.getElementById(id).value = "";
            }
            break;
        case 'password2':
            let password = document.getElementById('password').value;
            if (password != value){
                alert("La contraseña no coincide");
                document.getElementById(id).value = "";
            }
            break;
    }
}