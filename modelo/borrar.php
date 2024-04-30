<?php

class crudD{

    public static function borrar( $ced){
        include_once ("conexion.php");
        $obj=new conexion();
        $con = $obj->con();
        //$ced = $_GET["cedula"];
        $sql="Delete from estudiante where cedula='$ced'";
        $resul = $con->prepare($sql);
        $resul -> execute();
        $con->commit();
        echo json_encode($resul);
        
    }
}