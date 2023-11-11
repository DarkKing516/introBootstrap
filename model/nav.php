<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Para acceder a esta informacion debe iniciar sesion')
    window.location.href = './signin.php'</script>";
}

if (isset($_GET['session'])) {
    session_unset();
    echo "<script>alert('Cerrando la sesion')
    window.location.href = './signin.php'</script>";
}
?>

<style>
    /* Estilos para el contenedor circular de la imagen */
    .circle-image-container {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        /* Hace que el contenedor sea circular */
        overflow: hidden;
        /* Oculta cualquier parte de la imagen que esté fuera del círculo */
        margin: 0 auto;
        /* Centra el contenedor horizontalmente */
        background-color: #f0f0f0;
        /* Color de fondo para el contenedor */
    }

    /* Estilos para la imagen dentro del contenedor */
    .circle-image-container img {
        width: 100%;
        height: auto;
        /* Altura automática para mantener la relación de aspecto de la imagen */
        max-height: 100%;
        /* Limita la altura al 100% del contenedor */
        object-fit: cover;
        /* Escala y recorta la imagen para ajustarla al círculo */
    }

    /* Clase para ocultar el contenedor */
    .hidden-image {
        display: none;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">db Ventas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="cliente.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="empleado.php">Empleados</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venta.php">Venta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Detalle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="detalle_venta.php">Detalle & Venta</a>
                </li>
            </ul>

            <!-- Default dropstart button -->
            <div class="btn-group dropstart">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['usuario'] ?>
                </button>
                <ul class="dropdown-menu">
                    <!-- <li><a class="dropdown-item" href="#"><img src="https://www.kogstatic.com/gen_images/b9/62/b962d8a6-bd30-49e8-b121-cdc7196afe7b.png" alt=""></a></li> -->
                    <li><a class="dropdown-item" href="#"><img width="200px" class="list-group-item list-group-item-action disabled" src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['imgPerfil']) ?>" alt="imagen de Perfil"></a></li>
                    <a href="#" class="list-group-item list-group-item-action disabled"><?php echo $_SESSION['nombre'] ?></a>
                    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><?php echo $_SESSION['correo'] ?></a>
                    <li><a class="dropdown-item secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</a></li>

                </ul>
            </div>&nbsp;&nbsp;
            <a type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Cerrar Sesión" href="<?php echo $_SERVER['PHP_SELF'] ?>?session=cerrar"><i class="bi bi-escape"></i></a>

        </div>
    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form runat="server" action="./controller/perfil.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="url" class="form-control visually-hidden" value="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group text-center p-3">
                        <img width="150px" style="border-radius: 15px" src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['imgPerfil']) ?>" alt="imagen de Perfil">
                    </div>
                    <div class="form-group">
                        <label>Imagen de Perfil (No Obligatoria):</label>
                        <input type="file" id="imgInp" name="imagen" class="form-control" />
                        <center>
                            <div class="circle-image-container hidden-image">
                                <img id="blah" src="#" alt="Tu imagen" />
                            </div>
                        </center>

                    </div>
                    <script>
                        imgInp.onchange = evt => {
                            const [file] = imgInp.files;
                            const container = document.querySelector('.circle-image-container'); // Seleccione el contenedor

                            if (file) {
                                // Muestra el contenedor si se ha seleccionado un archivo
                                container.style.display = 'block';
                                blah.src = URL.createObjectURL(file);
                            } else {
                                // Oculta el contenedor si no hay archivo seleccionado
                                container.style.display = 'none';
                            }
                        }
                    </script>
                    <div class="form-group">
                        <label>Documento:</label>
                        <input type="text" name="documento" class="form-control" value="<?php echo $_SESSION['idEmpleado'] ?>" required>
                        <input type="text" name="documentoV" class="form-control visually-hidden" value="<?php echo $_SESSION['idEmpleado'] ?>">
                    </div>
                    <div class="form-group">
                        <label>nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $_SESSION['nombre'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>correo:</label>
                        <input type="email" name="correo" class="form-control" value="<?php echo $_SESSION['correo'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>telefono:</label>
                        <input type="number" name="telefono" max="1000000000000" class="form-control" value="<?php echo $_SESSION['telefono'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>usuario:</label>
                        <input type="text" name="usuario" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <select name="estado" class="form-select" aria-label="Default select example">
                            <option value="0" <?php echo ($_SESSION["estado"] == 0) ? 'selected' : ''; ?>>0</option>
                            <option value="1" <?php echo ($_SESSION["estado"] == 1) ? 'selected' : ''; ?>>1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <div id="passwordHelpBlock" class="form-text">
                            No llenar este campo si no se desea actualizar
                        </div>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mx-auto d-flex">
                        <div class="col-4">
                        </div>
                        <!-- <div> -->
                        <!-- <a href="">¿Perdiste tu contraseña?</a> -->
                        <br>
                        <!-- <a href="./signin.php">¿Ya tienes cuenta? Ingresa</a> -->
                        <!-- </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>

            </div>
        </div>
        </form>
    </div>
</div>