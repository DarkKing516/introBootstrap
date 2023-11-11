<?php
include('./conexion.php');
$conex = getConexion();

$idClienteV = $_POST['idClienteV'];
$idCliente = $_POST['idCliente'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$estado = $_POST['estado'];

$queryExistencia = "SELECT * FROM cliente WHERE idCliente = '$idClienteV'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {

    $query = "UPDATE `cliente` SET `idCliente` = '$idCliente', `nombres` = '$nombre', `direccion` = '$direccion', `estado` = '$estado' WHERE `idCliente` = '$idClienteV'";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('cliente Actualizado Correctamente')
window.location.href = '../cliente.php'</script>";
} else {
    echo "<script>alert('cliente no encontrado')
    window.location.href = '../cliente.php'</script>";
}
