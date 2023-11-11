<?php
include('./conexion.php');
$conex = getConexion();

$documento = $_POST['documento'];
$documentoV = $_POST['documentoV'];
$nombre = $_POST['nombre'];
$correio = $_POST['correo'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$estado = $_POST['estado'];

session_start();
// $password = $_POST['password'];
$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $_SESSION['clave'];

// $nueva_contraseña = $_POST['nueva_contraseña'];
// if (!empty($nueva_contraseña)) {
//     // El usuario proporcionó una nueva contraseña, así que la actualizaremos.
//     $password = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
// } else {
//     // El usuario no proporcionó una nueva contraseña, mantendremos la contraseña existente.
//     $password = $_SESSION['clave'];
// }

// var_dump($_POST['password']);
// var_dump($password);

$url = $_POST['url'];

$queryExistencia = "SELECT * FROM empleado WHERE idEmpleado = '$documentoV'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (isset($_FILES['imagen']['tmp_name']) && !empty($_FILES['imagen']['tmp_name'])) {
    $imagen_binaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    if (mysqli_num_rows($consultaCod) > 0) {

        $query = "UPDATE `empleado` SET `idEmpleado` = '$documento', `nombre` = '$nombre', `correo` = '$correio', `telefono` = '$telefono', `usuario` = '$usuario', `clave` = '$password', `estado` = '$estado', `imgPerfil` = '$imagen_binaria' WHERE `idEmpleado` = '$documentoV'";

        $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");

        $queryExistencia = "SELECT * FROM empleado WHERE usuario = '$usuario'";
        $consultaCod = mysqli_query($conex, $queryExistencia);
        if (mysqli_num_rows($consultaCod) > 0) {
            $row = mysqli_fetch_assoc($consultaCod);
            $Passwordhashed = $row['clave'];

            $_SESSION['idEmpleado'] = $row['idEmpleado'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['clave'] = $row['clave'];
            $_SESSION['estado'] = $row['estado'];
            $_SESSION['imgPerfil'] = $row['imgPerfil'];
        }

        echo "<script>alert('Perfil Actualizado Correctamente')
    window.location.href = '" . $url . "'</script>";
    } else {
        echo "<script>alert('Perfil no encontrado')
        window.location.href = '" . $url . "'</script>";
    }
} else {
    if (mysqli_num_rows($consultaCod) > 0) {

        $query = "UPDATE `empleado` SET `idEmpleado` = '$documento', `nombre` = '$nombre', `correo` = '$correio', `telefono` = '$telefono', `usuario` = '$usuario', `clave` = '$password', `estado` = '$estado' WHERE `idEmpleado` = '$documentoV'";

        $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");

        $queryExistencia = "SELECT * FROM empleado WHERE usuario = '$usuario'";
        $consultaCod = mysqli_query($conex, $queryExistencia);
        if (mysqli_num_rows($consultaCod) > 0) {
            $row = mysqli_fetch_assoc($consultaCod);
            $Passwordhashed = $row['clave'];

            $_SESSION['idEmpleado'] = $row['idEmpleado'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['clave'] = $row['clave'];
            $_SESSION['estado'] = $row['estado'];
            $_SESSION['imgPerfil'] = $row['imgPerfil'];
        }

        echo "<script>alert('Perfil Actualizado Correctamente')
    window.location.href = '" . $url . "'</script>";
    } else {
        echo "<script>alert('Perfil no encontrado')
        window.location.href = '" . $url . "'</script>";
    }
}
