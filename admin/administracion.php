<?php
include("../php/conexion_backend.php");
$usuarios = "SELECT * FROM usuarios";
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
                <a href="administracion.php" onclick="window.location.href='administracion.php'" class="btnredi">Usuarios</a>
            </li>
             <li class="boton">
            <a href="manejo_membresias.php" onclick="window.location.href='manejo_membresias.php'" class="btnredi">Membresías</a>
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
        <!-- Sección de Usuarios -->
        <h2 id="usuarios">Administración de Usuarios</h2>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#agregarUsuarioModal">Agregar
            Usuario</button>
        <button class="btn btn-info mb-3" id="actualizarTabla">Actualizar Tabla</button>

        <script>
        document.getElementById('actualizarTabla').addEventListener('click', function() {
            location.reload();
        });
        </script>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>ID Roles</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Género</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Altura (cm)</th>
                        <th>Peso (kg)</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
            include '../php/conexion_backend.php'; 
            $usuarios = "SELECT * FROM usuarios";
            $resultado2 = mysqli_query($conexion, $usuarios);
            while($row = mysqli_fetch_assoc($resultado2)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_roles']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombres']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['genero']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                        <td><?php echo htmlspecialchars($row['altura']); ?> cm</td>
                        <td><?php echo htmlspecialchars($row['peso']); ?> kg</td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                        <td><?php echo '********'; ?></td>
                        <td class="btn-actions">
                            <button class="btn btn-primary btn-sm btn-edit" data-id="<?php echo $row['id']; ?>"
                                data-toggle="modal" data-target="#editarUsuarioModal">Editar</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row['id']; ?>"
                                data-toggle="modal" data-target="#confirmarEliminarModal">Eliminar</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Agregar Usuario -->
        <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" role="dialog"
            aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="agregarUsuarioForm" method="POST" action="../php/agregar_usuario.php">
                            <div class="form-group">
                                <label for="id_roles">Id Roles</label>
                                <select class="form-control" id="id_roles" name="id_roles" required>
                                    <option value="">Seleccione</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Cliente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombres">Nombre</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellido</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="form-group">
                                <label for="genero">Género</label>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="">Seleccione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="altura">Altura (cm)</label>
                                <input type="number" class="form-control" id="altura" name="altura" required>
                            </div>
                            <div class="form-group">
                                <label for="peso">Peso (kg)</label>
                                <input type="number" class="form-control" id="peso" name="peso" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="contrasena"
                                        required>

                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog"
        aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarUsuarioForm" method="POST" action="../php/editar_usuario.php">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_id_roles">Id Roles</label>
                            <select class="form-control" id="edit_id_roles" name="id_roles" required>
                                <option value="">Seleccione</option>
                                <option value="1">Administrador</option>
                                <option value="2">Cliente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_nombres">Nombre</label>
                            <input type="text" class="form-control" id="edit_nombres" name="nombres" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_apellidos">Apellido</label>
                            <input type="text" class="form-control" id="edit_apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_genero">Género</label>
                            <select class="form-control" id="edit_genero" name="genero" required>
                                <option value="">Seleccione</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="edit_fecha_nacimiento" name="fecha_nacimiento"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_altura">Altura (cm)</label>
                            <input type="number" class="form-control" id="edit_altura" name="altura" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_peso">Peso (kg)</label>
                            <input type="number" class="form-control" id="edit_peso" name="peso" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_usuario">Usuario</label>
                            <input type="text" class="form-control" id="edit_usuario" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password" name="password">

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Eliminación -->
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                    <form id="eliminarUsuarioForm" method="POST" action="../php/eliminar_usuario.php">
                        <input type="hidden" id="delete_id" name="id">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`../php/get_usuario.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_id_roles').value = data.id_roles;
                        document.getElementById('edit_nombres').value = data.nombres;
                        document.getElementById('edit_apellidos').value = data.apellidos;
                        document.getElementById('edit_genero').value = data.genero;
                        document.getElementById('edit_fecha_nacimiento').value = data
                            .fecha_nacimiento;
                        document.getElementById('edit_altura').value = data.altura;
                        document.getElementById('edit_peso').value = data.peso;
                        document.getElementById('edit_email').value = data.email;
                        document.getElementById('edit_usuario').value = data.usuario;
                    });
            });
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('delete_id').value = id;
            });
        });
    });
    </script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>

</html>