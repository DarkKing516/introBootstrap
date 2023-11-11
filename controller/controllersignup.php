<?php
include('./conexion.php');
$conex = getConexion();

$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
// $password = $_POST['password'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// password_verify($form, $bd)

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $permitidos = array("image/jpg", "image/jpeg", "image/png");
    $tipo = $_FILES['imagen']['type'];
    if (in_array($tipo, $permitidos)) {

        $imagen_binaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));


        $queryExistencia = "SELECT * FROM empleado WHERE idEmpleado = " . $documento;

        $consultaCod = mysqli_query($conex, $queryExistencia);

        if (mysqli_num_rows($consultaCod) > 0) {
            echo "<script>alert('Empleado NO, Empleado existente')
        window.location.href = '../signup.php'</script>";
        } else {
            $query = "INSERT INTO `empleado` (`idEmpleado`, `nombre`, `correo`, `telefono`, `usuario`, `clave`, `estado`, `imgPerfil`) VALUES ('$documento', '$nombre', '$correo', '$telefono', '$usuario', '$password', '0', '$imagen_binaria')";

            $registros = mysqli_query($conex, $query) or die("Error: " . mysqli_error($conex));


            echo "<script>alert('Empleado Guardado Correctamente')
        window.location.href = '../index.php'</script>";
            // sleep(5);
            // header("Location: ../signin.php");
        }
    } else {
        echo "<script>alert('Formato de imagen no válido. Por favor, sube una imagen en formato jpg, jpeg o png.')
        window.location.href = '../signup.php'</script>";
    }
} else {
    // else en caso de que no ingrese una foto ya que no es obligatoria
    $queryExistencia = "SELECT * FROM empleado WHERE idEmpleado = " . $documento;
    $img = "https://www.softzone.es/app/uploads/2018/04/guest.png?x=480&quality=40";
    $imagen_binaria = addslashes(file_get_contents($img));

    $consultaCod = mysqli_query($conex, $queryExistencia);

    if (mysqli_num_rows($consultaCod) > 0) {
        echo "<script>alert('Empleado NO, Empleado existente')
    window.location.href = '../signup.php'</script>";
    } else {
        $query = "INSERT INTO `empleado` (`idEmpleado`, `nombre`, `correo`, `telefono`, `usuario`, `clave`, `estado`, `imgPerfil`) VALUES ('$documento', '$nombre', '$correo', '$telefono', '$usuario', '$password', '0', '$imagen_binaria')";
        $registros = mysqli_query($conex, $query) or die("Problemas para conectar a la BD");
        echo "<script>alert('Empleado Guardado Correctamente')
    window.location.href = '../signin.php'</script>";
        // sleep(5);
        // header("Location: ../signin.php");
    }
}
