tablas();

function tablas() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './controlador/apiRest.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            var templete = '';
            data.forEach(function (estudiante) {
                templete += `
                    <tr est_ced="${estudiante.cedula}"
                        est_ape="${estudiante.apellido}"
                        est_nom="${estudiante.nombre}"
                        est_dir="${estudiante.direccion}"
                        est_tel="${estudiante.telefono}">
                        <td style="border: 1px solid black; padding: 8px;">${estudiante.cedula}</td>
                        <td style="border: 1px solid black; padding: 8px;">${estudiante.nombre}</td>
                        <td style="border: 1px solid black; padding: 8px;">${estudiante.apellido}</td>
                        <td style="border: 1px solid black; padding: 8px;">${estudiante.direccion}</td>
                        <td style="border: 1px solid black; padding: 8px;">${estudiante.telefono}</td>
                        <td style="border: 1px solid black; padding: 8px;"><input class="eliminar btn btn-danger" type="submit" value="Eliminar"> <input class="mod btn btn-warning" type="submit" value="Modificar"></td>
                    </tr>`;
            });
            document.getElementById('estudiantes').innerHTML = templete;
        }
    };
    xhr.send(); 
}

document.getElementById('formestudiante').addEventListener('submit', function(e) {
    e.preventDefault();

    let but = document.getElementById('btn').value;
    if (but == 'Enviar') {
        const postData = {
            cedula: document.getElementById('cedula').value,
            nombre: document.getElementById('nombre').value,
            apellido: document.getElementById('apellido').value,
            direccion: document.getElementById('direccion').value,
            telefono: document.getElementById('telefono').value
        };
        const jsonData = JSON.stringify(postData);

        // Configurar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './controlador/apiRest.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    tablas();
                    document.getElementById('formestudiante').reset();
                } else {
                    console.error('Error en la solicitud: ' + xhr.status);
                }
            }
        };
        xhr.send(jsonData);
    }
});

document.addEventListener('click', function(event) {
    // Verificar si el clic fue en un elemento con la clase 'eliminar'
    if (event.target.classList.contains('eliminar')) {
        // Obtener el elemento <tr> padre del botón que se hizo clic
        let elemento = event.target.parentElement.parentElement;
        // Obtener el valor del atributo 'est_ced' del elemento <tr>
        let ced = elemento.getAttribute('est_ced');

        // Realizar la solicitud AJAX DELETE
        var xhr = new XMLHttpRequest();
        xhr.open('DELETE', './controlador/apiRest.php?cedula=' + ced, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    tablas();
                } else {
                    console.error('Error en la solicitud: ' + xhr.status);
                }
            }
        };
        xhr.send();
    }
});
document.addEventListener('click', function(event) {
    // Verificar si el clic fue en un elemento con la clase 'mod'
    if (event.target.classList.contains('mod')) {
        let elemento = event.target.parentElement.parentElement;
        let ced = document.getElementById('cedula');
        let nom = document.getElementById('nombre');
        let ape = document.getElementById('apellido');
        let dir = document.getElementById('direccion');
        let tel = document.getElementById('telefono');

        // Establecer los valores de los campos con los atributos del elemento clicado
        ced.value = elemento.getAttribute('est_ced');
        nom.value = elemento.getAttribute('est_nom');
        ape.value = elemento.getAttribute('est_ape');
        dir.value = elemento.getAttribute('est_dir');
        tel.value = elemento.getAttribute('est_tel');

        // Cambiar el valor del botón a 'Modificar'
        document.getElementById('btn').value = 'Modificar';

        // Agregar un event listener al formulario para capturar el evento de envío
        document.getElementById('formestudiante').addEventListener('submit', function(e) {
            e.preventDefault();
            // Verificar si el botón está en modo 'Modificar'
            if (document.getElementById('btn').value === 'Modificar') {
                const postData = {
                    cedula: ced.value,
                    nombre: nom.value,
                    apellido: ape.value,
                    direccion: dir.value,
                    telefono: tel.value
                };
                const jsonData = JSON.stringify(postData);
                // Configurar y enviar la solicitud AJAX PUT
                var xhr = new XMLHttpRequest();
                xhr.open('PUT', './controlador/apiRest.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            tablas();
                            document.getElementById('formestudiante').reset();
                            // Cambiar el valor del botón a 'Enviar' después de enviar la solicitud
                            document.getElementById('btn').value = 'Enviar';
                        } else {
                            console.error('Error en la solicitud: ' + xhr.status);
                        }
                    }
                };
                xhr.send(jsonData);
            }
        });
    }
});

