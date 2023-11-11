<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <!-- Links Bootstrap -->
    <?php include('./model/bootstrap.php') ?>

    <link rel="stylesheet" href="./assets/css/style.css">
</head>
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


<body>
    <div class="padre">
        <div class="contenedorxd mt-4 col-lg-4 mx-auto">
            <div class="card col-sm-10">
                <div class="card-body">

                    <form runat="server" action="./controller/controllersignup.php" method="post" enctype="multipart/form-data">
                        <div class="form-group text-center p-3">
                            <h2>Registrarse</h2>
                        </div>
                        <div class="form-group">
                            <label>Imagen de Perfil (No Obligatoria):</label>
                            <input accept="image/*" type="file" id="imgInp" name="imagen" class="form-control" />
                            <center>
                                <div class="circle-image-container hidden-image"> <!-- Aplica la clase al contenedor -->
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
                            <input type="number" name="documento" max="100000000000" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>nombre:</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>correo:</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>telefono:</label>
                            <input type="number" name="telefono" max="1000000000000" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>usuario:</label>
                            <input type="text" name="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mx-auto d-flex">
                            <div class="col-4">
                                <input type="submit" name="accion" value="Ingresar" class=" mt-2 btn btn-primary btn-lg btn-block">
                            </div>
                            <div>
                                <a href="a.php">¿Perdiste tu contraseña?</a>
                                <br>
                                <a href="./signin.php">¿Ya tienes cuenta? Ingresa</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>