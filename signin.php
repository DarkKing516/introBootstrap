<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Links Bootstrap -->
    <?php include('./model/bootstrap.php') ?>
    <!-- Incluye jQuery y Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="contenedorxd mt-4 col-lg-4 mx-auto">
        <div class="card col-sm-10">
            <div class="card-body">
                <form action="./signin.php" method="post">
                    <div class="form-group text-center p-3">
                        <h2>Login</h2>
                        <img src="./assets/img/quebendicionve.jpg" alt="70" width="170"> <label>Bienvenido al sistema</label>
                    </div>
                    <?php
                    include('./controller/conexion.php');
                    $conex = getConexion();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $usuario = $_POST['usuario'];
                        $password = $_POST['password'];

                        $queryExistencia = "SELECT * FROM empleado WHERE usuario = '$usuario'";
                        $consultaCod = mysqli_query($conex, $queryExistencia);

                        if (mysqli_num_rows($consultaCod) > 0) {
                            $row = mysqli_fetch_assoc($consultaCod);

                            $Passwordhashed = $row['clave'];

                            if (password_verify($password, $Passwordhashed)) {
                                session_start();
                                $_SESSION['idEmpleado'] = $row['idEmpleado'];
                                $_SESSION['nombre'] = $row['nombre'];
                                $_SESSION['correo'] = $row['correo'];
                                $_SESSION['telefono'] = $row['telefono'];
                                $_SESSION['usuario'] = $row['usuario'];
                                $_SESSION['clave'] = $row['clave'];
                                $_SESSION['estado'] = $row['estado'];
                                $_SESSION['imgPerfil'] = $row['imgPerfil'];

                                echo '<script type="text/javascript">
                                $(document).ready(function(){
                                    $("#exampleModal").modal("show");
                                });
                              </script>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                        La Contraseña es incorrecta!
                                    </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                    Usuario NO Encontrado!
                                </div>';
                        }
                    }

                    ?>

                    <div class="form-group">

                        <label>Usuario:</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mx-auto d-flex">
                        <div class="col-4">
                            <input type="submit" name="accion" value="Ingresar" class=" mt-2 btn btn-primary btn-lg btn-block">
                        </div>
                        <div>
                            <a href="./a.php">¿Perdiste tu contraseña?</a>
                            <br>
                            <a href="./signup.php">¿No tienes cuenta? Registrate</a>
                        </div>
                    </div>
                </form>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <!-- <div class="modal-content"> -->
                        <!-- <div class="modal-body"> -->
                        <div class="alert alert-success modal-content" role="alert">
                            <h4 class="alert-heading">Inicio de sesion correcto!</h4>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-outline-primary" href="index.php">Siguiente</a>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>


</html>