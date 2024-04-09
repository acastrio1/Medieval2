<?php
class Database{
    public static function connect(){
        //conexion: localhost,nombre usuario, coontraseña, nombre de la base de datos
        $conexion = new mysqli("localhost","root","","medieval");
        //Para que la base de datos venga codificada en UTF8
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>