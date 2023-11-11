<?php
include('./conexion.php');
$conex = getConexion();

$idEmpleadoV = $_POST['idEmpleadoV'];
$idEmpleado = $_POST['idEmpleado'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$estado = $_POST['estado'];

$queryExistencia = "SELECT * FROM empleado WHERE idEmpleado = '$idEmpleadoV'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {

    $query = "UPDATE `empleado` SET `idEmpleado` = '$idEmpleado', `nombre` = '$nombre', `correo` = '$correo', `telefono` = '$telefono', `usuario` = '$usuario', `estado` = '$estado' WHERE`idEmpleado` = '$idEmpleadoV'";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('Emplaedo Actualizado Correctamente')
window.location.href = '../empleado.php'</script>";
} else {
    // echo "<script>alert('empleado no encontrado')
    // window.location.href = '../empleado.php'</script>";
}
