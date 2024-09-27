<?php
include("../php/conexion_backend.php");
$miembros_query = "SELECT * FROM miembros";
$tipo_membresia_query = "SELECT * FROM tipo_membresia";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <nav id="sidebar" class="navleft">
        <div class="sidebar-header p-4">
            <img src="../imagenes/admin.png" alt="">
        </div>

        <ul class="itemm">
            <li class="boton">
                <a href="administracion.php" onclick="window.location.href='administracion.php'"
                    class="btnredi">Usuarios</a>
            </li>
            <li class="boton">
                <a href="manejo_membresias.php" onclick="window.location.href='manejo_membresias.php'"
                    class="btnredi">Membresías</a>
            </li>
        </ul>

        <a href="../php/cerrar_sesion.php">
            <button class="Btn ">
                <div class="sign">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                        </path>
                    </svg>
                </div>
                <div class="text">Logout</div>
            </button>
        </a>
    </nav>

    <div id="content" class="container mt-5">
        <h1 class="mb-4">Panel de Administrador</h1>
        <hr>
        <br>
        <!-- Sección de Membresías -->
        <h2 id="membresias">Registros de Membresías</h2>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Id Membresía</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $resultado_membresia = mysqli_query($conexion, $tipo_membresia_query);
                    while($row = mysqli_fetch_assoc($resultado_membresia)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_tipo_membresia']); ?></td>
                        <td><?php echo htmlspecialchars($row['membresia']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($row['precio']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <br><br>
        <!-- Sección de Miembros -->
        <h2 id="miembros">Administración de Miembros</h2>

        <!-- Botón para abrir el modal de agregar miembro -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">
            Agregar Miembro
        </button>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Id Miembro</th>
                        <th>Id Usuario</th>
                        <th>Id Tipo Membresía</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
            $resultado_miembros = mysqli_query($conexion, $miembros_query);
            while($row = mysqli_fetch_assoc($resultado_miembros)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_miembros']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_tipo_membresia']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_fin']); ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"
                                data-id="<?php echo $row['id_miembros']; ?>"
                                data-usuario="<?php echo $row['id_usuario']; ?>"
                                data-tipo="<?php echo $row['id_tipo_membresia']; ?>"
                                data-inicio="<?php echo $row['fecha_inicio']; ?>"
                                data-fin="<?php echo $row['fecha_fin']; ?>">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                data-id="<?php echo $row['id_miembros']; ?>">Eliminar</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para Agregar -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="../php/miembros_crud.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Agregar Miembro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos del formulario para agregar miembro -->
                            <input type="hidden" name="action" value="add">
                            <div class="form-group">
                                <label for="add-id_usuario">ID Usuario</label>
                                <input type="number" class="form-control" id="add-id_usuario" name="id_usuario"
                                    required min="1">
                            </div>
                            <div class="form-group">
                                <label for="add-id_tipo_membresia">ID Tipo Membresía</label>
                                <input type="number" class="form-control" id="add-id_tipo_membresia"
                                    name="id_tipo_membresia" required min="1" max="3">
                            </div>

                            <div class="form-group">
                                <label for="add-fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="add-fecha_inicio" name="fecha_inicio"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="add-fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="add-fecha_fin" name="fecha_fin" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para Editar -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="../php/miembros_crud.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Miembro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos del formulario para editar miembro -->
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" id="edit-id_miembros" name="id_miembros">
                            <div class="form-group">
                                <label for="edit-id_usuario">ID Usuario</label>
                                <input type="number" class="form-control" id="edit-id_usuario" name="id_usuario"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit-id_tipo_membresia">ID Tipo Membresía</label>
                                <input type="number" class="form-control" id="edit-id_tipo_membresia"
                                    name="id_tipo_membresia" required min="1" max="3">
                            </div>
                            <div class="form-group">
                                <label for="edit-fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="edit-fecha_inicio" name="fecha_inicio"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit-fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="edit-fecha_fin" name="fecha_fin" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para Eliminar -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="../php/miembros_crud.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Eliminar Miembro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Confirmación para eliminar miembro -->
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" id="delete-id_miembros" name="id_miembros">
                            <p>¿Estás seguro de que deseas eliminar este miembro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- Bootstrap JS y dependencias -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_miembros = button.data('id');
            var id_usuario = button.data('usuario');
            var id_tipo_membresia = button.data('tipo');
            var fecha_inicio = button.data('inicio');
            var fecha_fin = button.data('fin');

            var modal = $(this);
            modal.find('#edit-id_miembros').val(id_miembros);
            modal.find('#edit-id_usuario').val(id_usuario);
            modal.find('#edit-id_tipo_membresia').val(id_tipo_membresia);
            modal.find('#edit-fecha_inicio').val(fecha_inicio);
            modal.find('#edit-fecha_fin').val(fecha_fin);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_miembros = button.data('id');

            var modal = $(this);
            modal.find('#delete-id_miembros').val(id_miembros);
        });
        </script>

    </div>
</body>

</html>