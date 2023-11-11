<?php
function getConexion(){
    $host = "sql302.infinityfree.com";
    $user = "epiz_34069";
    $password = "eZPYXicZXwLv";
    $bd = "epiz_34069832_bdventas";

    $conexion = mysqli_connect($host, $user, $password, $bd);
    return $conexion;
}
?>