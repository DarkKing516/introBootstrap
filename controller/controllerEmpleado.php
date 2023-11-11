<?php
include('./conexion.php');
$conex = getConexion();

if (isset($_GET['eliminar'])) {
    $idEmpleado = $_GET['eliminar'];
    $query = "DELETE FROM empleado WHERE idEmpleado = $idEmpleado";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('empleado eliminado Correctamente')
window.location.href = '../empleado.php'</script>";
exit();
}
