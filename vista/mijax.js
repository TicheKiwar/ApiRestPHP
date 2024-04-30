$(document).ready(function(){
    $("#btn").click(function(){
    $.ajax({
        url:"consulta.php",
        type:"GET",
        dataType:"json",
        success:function(data){
            console.log(data)
        }
    });
});

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

})