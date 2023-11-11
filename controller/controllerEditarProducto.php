<?php
include('./conexion.php');
$conex = getConexion();

$idProductoV = $_POST['idProductoV'];
$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descuento = $_POST['descuento'];
$stock = $_POST['stock'];
$estado = $_POST['estado'];

$queryExistencia = "SELECT * FROM producto WHERE idProducto = '$idProductoV'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {
    $query = "UPDATE producto SET `idProducto` = '$idProducto', `nombre` = '$nombre', `precio` = '$precio', `descuento` = '$descuento', `stock` = '$stock', `estado` = '$estado' WHERE idProducto = '$idProductoV'";
    
    $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
    echo "<script>alert('Producto Actualizado Correctamente')
    window.location.href = '../producto.php'</script>";
} else {
        echo "<script>alert('Producto NO, Producto existente')
    window.location.href = '../producto.php'</script>";
}