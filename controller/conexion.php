<?php
function getConexion(){
    $host = "localhost";
    $user = "root";
    $password = "";
    $bd = "bdventas";

    $conexion = mysqli_connect($host, $user, $password, $bd);
    return $conexion;
}
?>