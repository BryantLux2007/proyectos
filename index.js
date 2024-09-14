// Obtener los elementos necesarios
const formulario = document.getElementById('formulario');
const mensajeEnviado = document.getElementById('mensaje-enviado');

// Escuchar el evento submit del formulario
formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe

    // Mostrar el mensaje de confirmación
    mensajeEnviado.style.display = 'block';

    // Ocultar el mensaje después de 3 segundos
    setTimeout(() => {
        mensajeEnviado.style.display = 'none';
    }, 3000);

    // Borrar los datos del formulario
    formulario.reset();
});
