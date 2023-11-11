<?php
include('./conexion.php');
$conex = getConexion();

if (isset($_GET['eliminar'])) {
    $idProducto = $_GET['eliminar'];
    $query = "DELETE FROM producto WHERE idProducto = $idProducto";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('Producto eliminado Correctamente')
window.location.href = '../producto.php'</script>";
exit();
}

// $idProductoV = $_POST['idProductoV'];
$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descuento = $_POST['descuento'];
$stock = $_POST['stock'];
$estado = $_POST['estado'];

$queryExistencia = "SELECT * FROM producto WHERE idProducto = '$idProducto'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {
    echo "<script>alert('Producto NO, Producto existente')
window.location.href = '../producto.php'</script>";
} else {
    // $query = "UPDATE `producto` SET `idProducto` = '$idProducto', `nombre` = '$nombre', `precio` = '$precio', `descuento` = '$descuento', `stock` = '$stock', `estado` = '$estado' WHERE `idProducto` = `$idProductoV`";
    $query = "INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `descuento`, `stock`, `estado`) VALUES ('$idProducto', '$nombre', '$precio', '$descuento', '$stock', '$estado')";

    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('Producto Guardado Correctamente')
window.location.href = '../producto.php'</script>";
}
