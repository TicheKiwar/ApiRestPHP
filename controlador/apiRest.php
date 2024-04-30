<?php

    include_once ("../modelo/consulta.php");
    include_once ("../modelo/borrar.php");
    include_once ("../modelo/guardar.php");
    include_once ("../modelo/modificar.php");
    header('Content-Type: application/json');
    $opt = $_SERVER["REQUEST_METHOD"];

    switch($opt){
        case "GET":
            crudS::selescionar();
            break;
        case "POST":
            $datoG = json_decode(file_get_contents('php://input'));
            //print_r($dato);
            crudG::Guardar($datoG -> cedula,$datoG -> nombre,$datoG -> apellido,$datoG -> direccion,
            $datoG -> telefono);
            break;
        case "DELETE":
            if (isset($_GET['cedula'])) {
                crudD::borrar($_GET['cedula']);
            }
            break;
        case "PUT":
            $datoMod = json_decode(file_get_contents('php://input'));
            //print_r($dato);
            crudM::modificar($datoMod -> cedula,$datoMod -> nombre,$datoMod -> apellido,$datoMod -> direccion,
            $datoMod -> telefono);
            break;
    }

