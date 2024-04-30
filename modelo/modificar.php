<?php

class CrudM{
    public static function modificar ($cedula,$nombre,$apellido,$direccion,$telefono){
        include_once "conexion.php";
        $sql = "Update estudiante set nombre='$nombre',apellido='$apellido',direccion='$direccion',telefono='$telefono' where cedula ='$cedula'";
        $con = new conexion();
        $req = $con -> con();
        $resul = $req -> prepare($sql);
        $resul -> execute();
        echo json_encode($resul);
        $req->commit();
    }
}