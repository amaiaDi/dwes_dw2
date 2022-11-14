document.getElementById("formulario").addEventListener('submit', validarPass); 
function validarPass(e){
    e.preventDefault();
    var pw1 = document.getElementById("pass").value;
    var pw2 = document.getElementById("rep_pass").value;
    if(pw1 != pw2){
        return;
    }
    this.submit();
}