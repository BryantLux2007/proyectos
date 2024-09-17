const formulario = document.getElementById('formulario');
const mensajeEnviado = document.getElementById('mensaje-enviado');

formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe

    mensajeEnviado.style.display = 'block';

    setTimeout(() => {
        mensajeEnviado.style.display = 'none';
    }, 3000);

    formulario.reset();
});
