<?php
/*
header( "content_type: application/json;charset=utf-8");
//jason ecode
$object = new stdClass();
$object->nombre="kiwar";
$object-> apellido="Tiche";
$object->edad=20;
print_r($object);

$miJson = json_encode($object);
echo "</br>";
echo $miJson;
echo "</br>";

//array simple de php a json
$colores = array("rojo", "azul","verde");
print_r($colores);
echo "</br>";
$miJson1 = json_encode($colores);
echo $miJson1;
echo "</br>";

//Array asosiativo de php a json

$asociativo = array("nombre"=>"kiwar","apellido"=>"Tiche");
print_r($asociativo);
echo "</br>";
$js=json_encode($asociativo,JSON_UNESCAPED_UNICODE);
echo ($js);*/

$lista='{
    "nombre":"kiwar",
    "apellido":"Tiche"
}';

print_r($lista);

$miJson = json_decode($lista);

print_r($miJson);


//PARA CREAR SERVICIOS
// Se va a usar GET POST PUT y DELETE
//Procesos CRUD
//GET=read=Select
//POST=Create
//PUT=Update
//Delete=delete
//----------Estados 
//200 -- Estado exitoso o que se realizó la transacción
//400 -- no encontrado (Ruta incorecta)
//404 -- error del servicio (error de programación)

//XMLHttpRequest es para: Obtener facil la informacion de una URL sin tener que recargar la página completa.





