//Elementos
const btn = document.querySelector('button');
const p = document.querySelector('p');

const comprobrar = (e) => {
    const password = document.querySelector('input[name="password"]').value;
    const password1 = document.querySelector('input[name="password1"]').value;
    if(password != password1)
    {
        e.preventDefault();
        p.innerHTML = "La Contraseña no coincide";
        p.style = "color: red";
    }
}

btn.addEventListener('click', comprobrar);