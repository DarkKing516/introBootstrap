<?php
include('./conexion.php');
$conex = getConexion();

if (isset($_GET['eliminar'])) {
    $idCliente = $_GET['eliminar'];
    $query = "DELETE FROM cliente WHERE idCliente = $idCliente";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('cliente eliminado Correctamente')
window.location.href = '../cliente.php'</script>";
exit();
}

$idCliente = $_POST['idCliente'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$estado = $_POST['estado'];

$queryExistencia = "SELECT * FROM cliente WHERE idCliente = '$idCliente'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {
    echo "<script>alert('cliente NO, cliente existente')
window.location.href = '../cliente.php'</script>";
} else {
    $query = "INSERT INTO `cliente` (`idCliente`, `nombres`, `direccion`, `estado`) VALUES ('$idCliente', '$nombre', '$direccion', '$estado')";
    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('cliente Guardado Correctamente')
window.location.href = '../cliente.php'</script>";
}
