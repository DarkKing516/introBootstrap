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
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('./controller/conexion.php');
                $conex = getConexion();

                // Consulta SQL para seleccionar los datos de la tabla (reemplaza "tu_tabla" con el nombre de tu tabla)
                $sql = "SELECT * FROM empleado";
                $result = $conex->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idEmpleado"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["correo"] . "</td>";
                        echo "<td>" . $row["telefono"] . "</td>";
                        echo "<td>" . $row["usuario"] . "</td>";
                        echo "<td> ****** </td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "<td>" . '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["idEmpleado"] . '">
                        <i class="bi bi-pen-fill"></i>
                          </button>
                          <a type="button" class="btn btn-outline-danger" href="./controller/controllerEmpleado.php?eliminar=' . $row["idEmpleado"] . '">
                          <i class="bi bi-person-x"></i>
                          </a>
                          ' . "</td>";
                        echo "</tr>";
                ?>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $row["idEmpleado"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="./controller/controllerEditarEmpleado.php" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Documento</label>
                                                <input type="number" name="idEmpleadoV" placeholder="N° Identidad" max="100000000000" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row["idEmpleado"] ?>" hidden>
                                                <input type="number" name="idEmpleado" placeholder="N° Identidad" max="100000000000" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row["idEmpleado"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Nombre</label>
                                                <input type="text" name="nombre" placeholder="nombre" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["nombre"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Correo</label>
                                                <input type="text" name="correo" placeholder="Correo" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["correo"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Telefono</label>
                                                <input type="text" name="telefono" placeholder="Telefono" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["telefono"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Usuario</label>
                                                <input type="text" name="usuario" placeholder="Usuario" maxlength="50" class="form-control" id="exampleInputPassword1" value="<?php echo $row["usuario"] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPassword5" class="form-label">Contraseña</label>
                                                <input type="password" name="usuario" placeholder="Usuario" maxlength="50" class="form-control" id="exampleInputPassword1" value="******" disabled>
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
</body>

</html>