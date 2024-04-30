<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api REST Simple</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body style="background-color: azure;">
    <div style="margin-top: 10px;
                font-style: italic;
                justify-content: center;
                background-color: darkblue;
                align-items: center;
                text-align: center;
    ">
        <h1 style="color: seashell;
        justify-content: center;
    ">
    CRUD CON MVC</h1>
    </div>

    <div style="margin-left: 75px;">
        <form id = 'formestudiante'>
            <label style="display: inline-block; width: 100px;">Cedula</label>
            <input id="cedula" type="text" required><br>
            
            <label style="display: inline-block; width: 100px;">Nombre</label>
            <input  id="nombre" type="text" required><br>
            
            <label style="display: inline-block; width: 100px;">Apellido</label>
            <input id="apellido" type="text" required><br>
            
            <label style="display: inline-block; width: 100px;">Direccion</label>
            <input id="direccion" type="text" required><br>
            
            <label style="display: inline-block; width: 100px;">Telefono</label>
            <input id="telefono" type="text" required><br>
            <input id="btn" style="margin-left: 90px; margin-top: 25px;" type="submit" value="Enviar">
        </form>
    </div>
    <div style="margin-left: 90px; margin-top: 25px;">
        <table style="border-collapse: collapse;">
            <tr>
                <th style="border: 1px solid black; padding: 8px;">Cedula</th>
                <th style="border: 1px solid black; padding: 8px;">Nombre</th>
                <th style="border: 1px solid black; padding: 8px;">Apellido</th>
                <th style="border: 1px solid black; padding: 8px;">Direccion</th>
                <th style="border: 1px solid black; padding: 8px;">Telefono</th>
            </tr>
            <tbody id="estudiantes">

            </tbody>

        </table>
        
        <script  >
            
tablas();

$('#formestudiante').submit(function(e){
    e.preventDefault();
    
        let but = document.getElementById('btn').value;
        if (but == 'Enviar' ) {
                const postData = {
                cedula : $('#cedula').val(),
                nombre : $('#nombre').val(),
                apellido : $('#apellido').val(),
                direccion : $('#direccion').val(),
                telefono : $('#telefono').val()
            };
            const jsonData = JSON.stringify(postData);
            // Configurar la solicitud AJAX
            $.ajax({
                url: 'http://empresa.ec/controlador/apiRest.php',
                type: 'POST',
                contentType: 'application/json', 
                data: jsonData, // Datos en formato JSON
                success: function(response){
                    console.log(response);
                    tablas();
                    $('#formestudiante').trigger('reset');
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        }
    
    
    
    
});


function tablas (){
$.ajax({

    url:'http://empresa.ec/controlador/apiRest.php',
    type : 'GET',
    success : function (data){
        let estudiantes = JSON.parse(data);
        let templete = '';
        estudiantes.forEach(estudiante =>{
            templete+= `
                <tr est_ced=" ${estudiante.cedula  }"
                    est_ape=" ${estudiante.apellido}"
                    est_nom="  ${estudiante.nombre }"
                    est_dir="${estudiante.direccion}"
                    est_tel=" ${estudiante.telefono}" 
                >
                    <td  style="border: 1px solid black; padding: 8px;"> ${estudiante.cedula }</td>
                    <td  style="border: 1px solid black; padding: 8px;"> ${estudiante.nombre }</td>
                    <td  style="border: 1px solid black; padding: 8px;"> ${estudiante.apellido }</td>
                    <td  style="border: 1px solid black; padding: 8px;"> ${estudiante.direccion }</td>
                    <td  style="border: 1px solid black; padding: 8px;"> ${estudiante.telefono }</td>
                    <td style="border: 1px solid black; padding: 8px;"><input class="eliminar"  type="submit" value="Eliminar"> <input class="mod"  type="submit" value="Modificar"> </td>
                </tr>
            `
        })
        $('#estudiantes').html(templete);
    }
})
}

$(document).on('click','.eliminar',function(){
let elemento= $(this)[0].parentElement.parentElement;
let ced = $(elemento).attr('est_ced');
$.ajax({
    url:'http://empresa.ec/controlador/apiRest.php?cedula='+ced,
    type:'DELETE',
    success: function(response){
        console.log(response);
        tablas();
    }
})
tablas();
})
$(document).on('click','.mod',function(){
let elemento= $(this)[0].parentElement.parentElement;
let ced = document.getElementById('cedula');
let nom = document.getElementById('nombre');
let ape = document.getElementById('apellido');
let dir = document.getElementById('direccion');
let tel = document.getElementById('telefono');
ced.value = $(elemento).attr('est_ced');
nom.value = $(elemento).attr('est_nom');
ape.value = $(elemento).attr('est_ape');
dir.value = $(elemento).attr('est_dir');
tel.value = $(elemento).attr('est_tel');
let but = document.getElementById('btn').value='Modificar';
$('#formestudiante').submit(function(e){
    if (but == 'Modificar' ) {
        const postData = {
            cedula : $('#cedula').val(),
            nombre : $('#nombre').val(),
            apellido : $('#apellido').val(),
            direccion : $('#direccion').val(),
            telefono : $('#telefono').val()
        };
        const jsonO = JSON.stringify(postData);
        $.ajax({
            url:'./controlador/apiRest.php',
            type:'PUT',
            contentType:'application/json',
            data:jsonO,
            success: function(response){
                console.log(response);
                tablas();
                $('#formestudiante').trigger('reset');
                let but = document.getElementById('btn').value='Enviar';
            }
        })
    }
})
})
        </script>
    </div>

</body>
</html>