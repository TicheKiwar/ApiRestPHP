<?php

class conexion {

    public function con(){

        define(
            "server","localHost"
        );
        define(
            "db","quinto"
        );
        define(
            "user","root"
        );
        define(
            "pas","root"
        );

        $opc=array(PDO::MYSQL_ATTR_INIT_COMMAND> "SET NAMES utf8");

        try {
            $con=new PDO("mysql: host=".server.";dbname=".db,user,pas,$opc);
            return $con;
        } catch (\Throwable $th) {
            die("error en la conexion ".$th->getMessage());
        }
    }
}