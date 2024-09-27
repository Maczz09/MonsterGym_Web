<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'monster_gym_db');
$id_usuario = $_SESSION['id_usuario'];

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$query = "SELECT usuarios.nombres, usuarios.apellidos, usuarios.email, usuarios.genero, usuarios.fecha_nacimiento, 
                 tipo_membresia.membresia, miembros.fecha_inicio, miembros.fecha_fin 
          FROM usuarios 
          LEFT JOIN miembros ON usuarios.id = miembros.id_usuario 
          LEFT JOIN tipo_membresia ON miembros.id_tipo_membresia = tipo_membresia.id_tipo_membresia 
          WHERE usuarios.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];

    if ($contrasena) {
        $contrasena = hash('sha512', $contrasena);
        $query = "UPDATE usuarios SET nombres = ?, apellidos = ?, contrasena = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $nombre, $apellido, $contrasena, $id_usuario);
    } else {
        $query = "UPDATE usuarios SET nombres = ?, apellidos = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $nombre, $apellido, $id_usuario);
    }

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $response = array("status" => "success", "message" => "Datos actualizados con éxito");
        } else {
            $response = array("status" => "error", "message" => "No se hicieron cambios en los datos");
        }
    } else {
        $response = array("status" => "error", "message" => "Error al ejecutar la consulta: " . $stmt->error);
    }

    echo json_encode($response);
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - MonsterGym</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body class="bg-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">Perfil</div>
                    <div class="card-body">
                        <div id="alert" style="display:none;" class="alert"></div>
                        <form id="profileForm">
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="<?php echo htmlspecialchars($userData['nombres']); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="apellido" name="apellido"
                                        value="<?php echo htmlspecialchars($userData['apellidos']); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="genero" class="col-md-4 col-form-label text-md-right">Género</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="genero" name="genero"
                                        value="<?php echo htmlspecialchars($userData['genero']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha de
                                    Nacimiento</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento"
                                        value="<?php echo htmlspecialchars($userData['fecha_nacimiento']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="membresia" class="col-md-4 col-form-label text-md-right">Membresía</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="membresia"
                                        value="<?php echo htmlspecialchars($userData['membresia']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">Fecha de
                                    Inicio</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="fecha_inicio"
                                        value="<?php echo htmlspecialchars($userData['fecha_inicio']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">Fecha de
                                    Fin</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="fecha_fin"
                                        value="<?php echo htmlspecialchars($userData['fecha_fin']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contrasena" class="col-md-4 col-form-label text-md-right">Nueva
                                    Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="contrasena" name="contrasena">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4">
                                    <button type="button" class="btn btn-secondary" onclick="goBack()">Regresar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function goBack() {
        window.location.href = "main.php";
    }

    document.getElementById('profileForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('profile.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json()).then(data => {
            var alert = document.getElementById('alert');
            if (data.status === 'success') {
                alert.className = 'alert alert-success';
            } else {
                alert.className = 'alert alert-danger';
            }
            alert.style.display = 'block';
            alert.innerText = data.message;

            if (data.status === 'success') {
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
</body>

</html>