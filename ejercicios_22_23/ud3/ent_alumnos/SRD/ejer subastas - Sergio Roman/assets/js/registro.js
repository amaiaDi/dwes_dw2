const button = document.querySelector("input[name='Registrarte']");

const comprobacionPasswordIguales = (e) => {
    const pass = document.querySelector("input[name='password']").value;
    const passRepeat = document.querySelector("input[name='password-repeat']").value;

    if(pass != passRepeat)
    {
        e.preventDefault();
        const p = document.querySelector('p');
        p.style.color = 'red';
        p.innerHTML = 'Las contraseñas no coinciden';
    }
}
button.addEventListener('click', comprobacionPasswordIguales);