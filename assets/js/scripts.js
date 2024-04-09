
/*document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#login');



    // event listener para el formulario
    form.addEventListener('submit', function(event) {
    // Prevent the form from submitting
        event.preventDefault();

        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;


        if (email.trim() === '' || !email.includes('@')) {
            error.innerHTML = 'Correo no válido';
          } else if (password.trim() === '') {
            error.innerHTML = 'password no puede ser vacío';
          } else {
            error.innerHTML = '';
            form.submit();
          }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#register');



    // event listener para el formulario
    form.addEventListener('submit', function(event) {
    // Prevent the form from submitting
        event.preventDefault();

        var nombre = document.querySelector('#nombre').value;
        var apellidos = document.querySelector('#apellidos').value;
        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;


        if (email.trim() === '' || !email.includes('@')) {
            error.innerHTML = 'Correo no válido';
          } else if (password.trim() === '') {
            error.innerHTML = 'password no puede ser vacío';
          } else if (nombre.trim() === '') {
            error.innerHTML = 'El nombre no puede estar vacío'; 
          }else if (apellidos.trim() === '') {
            error.innerHTML = 'El apellido no puede estar vacío';
          }else {
            error.innerHTML = '';
            form.submit();
          }
    });
});*/






let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
        	next = items[0]
      	}
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})
