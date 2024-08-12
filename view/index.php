<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/logo_faapi - icon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>FAAPI 2024 - Virtual Edition</title>
</head>
<body>
    <div class="menu-principal">
        <div class="enlaces" id="enlaces">
            <ul>
                <li><a href="info.html" class="conocenos">XLVIII FAAPI</a></li>
                <li><a href="index.php">INICIO</a></li>
                <li><a href="#" id="inscripcion-btn">INSCRIPCIÓN</a></li>
                <li><a href="#contacto">CONTACTO</a></li>
            </ul>
        </div>
    </div>

    <div class="logos">
        <img src="../img/logo_faapi.png" alt="Logo faapi" class="logo-1">
        <img src="../img/logo1.png" alt="Logo poli" class="logo-2">
    </div>

    <div class="animalitos">
        <img src="../img/animalitos.png" alt="animalitos">
    </div>

    <div class="logo-letras desplazar-izquierda">
        <img src="../img/letras.png" alt="logo letras">
    </div>

    <div class="letra-abajo desplazar-abajo">
        <img src="../img/federacion.png" alt="letra abajo">
    </div>

    <div id="inscripcion" class="seccion-inscripcion">
        <div class="formulario-contenedor">
            <form class="formulario-inscripcion" id="inscripcion-form">
                <label for="nombre">NOMBRE <span class="translation">(Name)</span>
                    <input type="text" id="nombre" name="nombre" required>
                </label>
                
                <label for="apellido">APELLIDO <span class="translation">(Last Name)</span>
                    <input type="text" id="apellido" name="apellido" required>
                </label>
                
                <label for="dni">D.N.I <span class="translation">(ID Number)</span>
                    <input type="text" id="dni" name="dni" required>
                </label>
                
                <label for="email">CORREO ELECTRÓNICO <span class="translation">(Email Address)</span>
                    <input type="email" id="email" name="email" required>
                </label>
                
                <label for="celular">CELULAR <span class="translation">(Phone Number)</span>
                    <input type="tel" id="celular" name="celular" required>
                </label>
                
                <label for="residencia">LUGAR DE RESIDENCIA <span class="translation">(Residence)</span>
                    <input type="text" id="residencia" name="residencia" required>
                </label>
                
                <label for="tipo">TIPO <span class="translation">(Type)</span>
                    <select id="tipo" name="tipo" required>
                        <option value="">Seleccione</option>
                        <option value="estudiante">Estudiante</option>
                        <option value="no_socio">No Socio</option>
                        <option value="miembro_faapi">Miembro FAAPI</option>
                        <option value="asistente_internacional">Asistente Internacional</option>
                    </select>
                </label>
                <br>
                <div class="botones">
                    <button type="button" class="btn-pago-transferencia" id="pago-transferencia">PAGO POR TRANSFERENCIA / Transfer payment</button>
                </div>
                
                <input type="hidden" id="pago-completado" name="pago_completado" value="no">
                
                <p>Financiación propia (Self-financing)</p>
            </form>
        </div>
    </div>

    <div id="contacto" class="seccion-contacto">
        <div class="formulario-contenedor">
            <form class="formulario-contacto" action="procesar_contacto.php" method="POST">
                <label for="nombre-contacto">NOMBRE <span class="translation">(Name)</span></label>
                <input type="text" id="nombre-contacto" name="nombre_contacto" required>
                
                <label for="email-contacto">CORREO ELECTRÓNICO <span class="translation">(Email Address)</span></label>
                <input type="email" id="email-contacto" name="email_contacto" required>
                
                <label for="mensaje">MENSAJE <span class="translation">(Message)</span></label>
                <textarea id="mensaje" name="mensaje" required></textarea>
                
                <div class="botones">
                    <button type="submit" class="btn-enviar">ENVIAR / Send</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/app.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inscripcionForm = document.getElementById('inscripcion-form');

            const urlsPago = {
                estudiante: "https://mpago.la/1X6xRKF",
                no_socio: "https://mpago.la/25zms15",
                miembro_faapi: "https://mpago.la/1JJS9dD"
                asistente_internacional: "https://mpago.la/1JJS9de"
            };

            const pagarBtn = document.getElementById('pagar');
            const tipoSelect = document.getElementById('tipo');

            tipoSelect.addEventListener('change', function() {
                const tipo = this.value;
                const urlPago = urlsPago[tipo] || null;

                pagarBtn.onclick = function() {
                    if (urlPago) {
                        guardarDatosFormulario();
                        window.location.href = urlPago;
                    } else {
                        alert('Por favor, seleccione un tipo de inscripción.');
                    }
                };
            });

            function guardarDatosFormulario() {
                const formData = new FormData(inscripcionForm);

                fetch('guardar_sesion.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Datos guardados en la sesión');
                    } else {
                        console.error('Error al guardar los datos en la sesión');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>
</body>
</html>