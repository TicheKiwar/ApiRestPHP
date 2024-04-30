<?php

class crudS{

    public static function selescionar(){
        include_once ("conexion.php");
        $objeto = new conexion();
        $con =$objeto->con();
        $sqlSelect = "SELECT * FROM estudiante";
        $resultado = $con->prepare($sqlSelect);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $valor = json_encode($data);
        print_r( $valor);
    }
}