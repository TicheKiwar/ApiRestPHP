<?php
class crudG{

    public static function Guardar($cedula,$nombre,$apellido,$direccion,$telefono){
        include_once ("conexion.php");
        $obj=new conexion();
        $con = $obj->con();
        $sql = "Insert into estudiante
        value ('$cedula','$nombre','$apellido','$direccion','$telefono')";
        $result = $con->prepare($sql);
        $result->execute();
        echo json_encode($result);
        $con->commit();
    }
}