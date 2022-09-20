// const loginForm = document.querySelector('#btnLogin');

// validación sencilla en el login

document.addEventListener('DOMContentLoaded', () => {
  loginForm.addEventListener('submit', (event) => {

    let name = document.querySelector('#user_name');
    let surname = document.querySelector('#user_surname');
    let password = document.querySelector('#user_pass');

    if(name.value.length <= 3){
      event.preventDefault();
      let nameHelp = document.querySelector("#nameHelp");
      nameHelp.innerHTML = "<span class='text-danger'>Mínimo 4 caracteres.</span>";
      name.focus();
      name.value = '';
      return;
    }
    // !!surname -> en login.php el campo apellido no existe
    if(!!surname && surname.value.length <= 3){
      event.preventDefault();
      let surnameHelp = document.querySelector("#nameHelp");
      surnameHelp.innerHTML = "<span class='text-danger'>Mínimo 4 caracteres.</span>";
      surname.focus();
      surname.value = '';
      return;
    }

    const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,14}$/;

    // 4-15 caracteres, al menos un número, una mayúscula y una minúscula
    if(!password.value.match(regex) && window.location.pathname == '/php/registro.php'){
      event.preventDefault();
      let passwordHelp = document.querySelector("#passwordHelp");
      passwordHelp.innerHTML = "<small><span class='text-danger'>La contraseña debe tener entre 4 y 15 caracteres, comenzar con una letra y contener, al menos, un número, una mayúscula y una minúscula.</span></small>";
      password.focus();
      password.value = '';
      return;
    }
  });
});
