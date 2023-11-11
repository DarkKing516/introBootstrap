<?php
include('./conexion.php');
$conex = getConexion();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$queryExistencia = "SELECT * FROM empleado WHERE usuario = '$usuario'";
$consultaCod = mysqli_query($conex, $queryExistencia);

if (mysqli_num_rows($consultaCod) > 0) {
    $row = mysqli_fetch_assoc($consultaCod);

    $Passwordhashed = $row['clave'];

    if (password_verify($password, $Passwordhashed)) {
        echo "<script>alert('Inicio de sesion Correctamente')
        window.location.href = '../index.php'</script>";
    } else {
        var_dump(password_verify($password, $Passwordhashed));
        var_dump($password, $Passwordhashed);
        echo "<script>alert('Contraseña incorrecta')
        window.location.href = '../signin.php'</script>";
    }
} else {
    echo "<script>alert('Usuario NO encontrado')
    window.location.href = '../signin.php'</script>";
}
?>