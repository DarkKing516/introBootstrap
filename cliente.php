<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <!-- Links Bootstrap -->
    <?php include('./model/bootstrap.php') ?>

</head>

<body>

    <?php include('./model/nav.php') ?>

    <br>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Añadir">
                            <i class="bi bi-person-fill-add"></i>
                        </button></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direecion</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('./controller/conexion.php');
                $conex = getConexion();

                // Consulta SQL para seleccionar los datos de la tabla (reemplaza "tu_tabla" con el nombre de tu tabla)
                $sql = "SELECT * FROM cliente";
                $result = $conex->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idCliente"] . "</td>";
                        echo "<td>" . $row["nombres"] . "</td>";
                        echo "<td>" . $row["direccion"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "<td>" . '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["idCliente"] . '">
                        <i class="bi bi-pen-fill"></i>
                          </button>
                          <a type="button" class="btn btn-outline-danger" href="./controller/controllerCliente.php?eliminar=' . $row["idCliente"] . '">
                          <i class="bi bi-person-x"></i>
                          </a>
                          ' . "</td>";
                        echo "</tr>";
                ?>
                        <div class="modal fade" id="exampleModal<?php echo $row["idCliente"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="./controller/controllerEditarCliente.php" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">ID</label>
                                                <input type="number" name="idClienteV" placeholder="N° Identidad" max="100000000000" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row["idCliente"] ?>" hidden>
                                                <input type="number" name="idCliente" placeholder="N° Identidad" max="100000000000" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row["idCliente"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Nombres</label>
                                                <input type="text" name="nombre" placeholder="Nombres" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["nombres"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Direccion</label>
                                                <input type="text" name="direccion" placeholder="Direccion" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["direccion"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Estado</label>
                                                <select name="estado" class="form-select" aria-label="Default select example">
                                                    <option value="0" <?php echo (($row["estado"] == 0) ? 'selected' : '') ?>>0</option>
                                                    <option value="1" <?php echo (($row["estado"] == 1) ? 'selected' : '') ?>>1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Limpiar</button>
                                            <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron registros.</td></tr>";
                }

                // Cerrar la conexión
                $conex->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- MODAL AGREGAR -->
    <div class="modal fade" id="Añadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./controller/controllerCliente.php" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <input type="number" name="idCliente" placeholder="N° Identidad" max="100000000000" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nombre" placeholder="Nombres" maxlength="50" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="direccion" placeholder="Direccion" maxlength="50" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <select name="estado" class="form-select" aria-label="Default select example">
                                <option selected>Estado</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Limpiar</button>
                        <button type="submit" class="btn btn-outline-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>