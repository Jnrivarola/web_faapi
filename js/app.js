document.addEventListener("DOMContentLoaded", function() {
    const inscripcionBtn = document.getElementById('inscripcion-btn');
    const contactoBtn = document.querySelector('a[href="#contacto"]');
    const formularioInscripcionContenedor = document.querySelector('.seccion-inscripcion .formulario-contenedor');
    const formularioContactoContenedor = document.querySelector('.seccion-contacto .formulario-contenedor');
    const tipoSelect = document.getElementById('tipo');
    const pagoTransferenciaBtn = document.getElementById('pago-transferencia');
    const pagoCompletadoInput = document.getElementById('pago-completado');
    const letraAbajo = document.querySelector('.letra-abajo');
    const logoLetras = document.querySelector('.logo-letras');
    const inscripcionForm = document.getElementById('inscripcion-form');

    const urlsPago = {
        estudiante: "",
        no_socio: "",
        miembro_faapi: "",
        asistente_internacional: ""
    };

    inscripcionBtn.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.hash = '#inscripcion';
    });

    contactoBtn.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.hash = '#contacto';
    });

    window.addEventListener('hashchange', function() {
        const hash = window.location.hash;

        if (hash === '#inscripcion') {
            formularioContactoContenedor.classList.remove('mostrar');
            formularioInscripcionContenedor.classList.add('mostrar');
            desplazarIzquierda();
        } else if (hash === '#contacto') {
            formularioInscripcionContenedor.classList.remove('mostrar');
            formularioContactoContenedor.classList.add('mostrar');
            desplazarIzquierda();
        } else {
            formularioInscripcionContenedor.classList.remove('mostrar');
            formularioContactoContenedor.classList.remove('mostrar');
            resetearPosicion();
        }
    });

    tipoSelect.addEventListener('change', function() {
        const tipo = this.value;
        const urlPago = urlsPago[tipo] || null;

        if (tipo !== '') {
            // Ocultar bot��n de "Gestionar Pago"
            document.getElementById('pagar').style.display = 'none';
            // Mostrar bot��n de "Pago por Transferencia"
            document.getElementById('pago-transferencia').style.display = 'inline-block';
        } else {
            // Mostrar boton de "Gestionar Pago" si no se ha seleccionado tipo
            document.getElementById('pagar').style.display = 'inline-block';
            // Ocultar bot��n de "Pago por Transferencia"
            document.getElementById('pago-transferencia').style.display = 'none';
        }
    });

    pagoTransferenciaBtn.addEventListener('click', function() {
        if (inscripcionForm.checkValidity()) { // Verificar validez del formulario
            guardarDatosFormulario(); // Guardar datos antes de enviar

            // Envio de formulario a base de datos
            fetch('https://politecnico.ar/procesar_formulario.php', {
                method: 'POST',
                body: new FormData(inscripcionForm)
            })
            .then(response => response.text())
            .then(data => {
                // Aqu�� podr��as manejar una respuesta del servidor si fuera necesaria
                console.log('Formulario enviado correctamente a la base de datos');
            })
            .catch(error => {
                console.error('Error al enviar formulario:', error);
            });

            // Env��o de correo electr��nico
            enviarCorreo();

            // Redirecci��n a confirmacion.php (esto asume que confirmaci��n se maneja adecuadamente por otro m��todo)
            window.location.href = 'https://politecnico.ar/confirmacion.php';
        } else {
            alert('Por favor, complete todos los campos del formulario.');
        }
    });

    function guardarDatosFormulario() {
        const formData = new FormData(inscripcionForm);

        fetch('https://politecnico.ar/guardar_sesion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Datos guardados en la sesi��n');
            } else {
                console.error('Error al guardar los datos en la sesi��n');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function enviarCorreo() {
        fetch('https://politecnico.ar/enviar_correo.php', {
            method: 'POST',
            body: new FormData(inscripcionForm)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Correo electr��nico enviado correctamente');
            } else {
                console.error('Error al enviar el correo electr��nico');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function desplazarIzquierda() {
        letraAbajo.classList.add('desplazar-abajo');
        logoLetras.classList.add('desplazar-izquierda');
    }

    function resetearPosicion() {
        letraAbajo.classList.remove('desplazar-abajo');
        logoLetras.classList.remove('desplazar-izquierda');
    }

    // Verificar el hash inicial para mostrar la secci��n correspondiente
    if (window.location.hash === '#inscripcion') {
        formularioInscripcionContenedor.classList.add('mostrar');
        desplazarIzquierda();
    } else if (window.location.hash === '#contacto') {
        formularioContactoContenedor.classList.add('mostrar');
        desplazarIzquierda();
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Configuración del IntersectionObserver
    const options = {
        root: null, // Observa el viewport
        rootMargin: '0px',
        threshold: 0.1 // Se activará cuando el 10% del elemento sea visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('pag-sec-visible');
            } else {
                entry.target.classList.remove('pag-sec-visible');
            }
        });
    }, options);

    // Observa los elementos que queremos animar
    document.querySelectorAll('.pag-sec1, .pag-sec2, .pag-sec3, .pag-sec4').forEach(element => {
        observer.observe(element);
    });
});