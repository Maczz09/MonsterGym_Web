<?php
session_start();
include 'conexion_backend.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id_roles = $_POST['id_roles'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $check_sql = "SELECT * FROM usuarios WHERE (email='$email' OR usuario='$usuario') AND id != '$id'";
    $result = mysqli_query($conexion, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('El nombre de usuario o el email ya están en uso.');
                window.location.href='../admin/administracion.php';
              </script>";
    } else {
        if (!empty($contrasena)) {
            $contrasena_hashed = hash('sha512', $contrasena);
            $sql = "UPDATE usuarios SET id_roles='$id_roles', nombres='$nombres', apellidos='$apellidos', genero='$genero', fecha_nacimiento='$fecha_nacimiento', altura='$altura', peso='$peso', email='$email', usuario='$usuario', contrasena='$contrasena_hashed' WHERE id='$id'";
        } else {
            $sql = "UPDATE usuarios SET id_roles='$id_roles', nombres='$nombres', apellidos='$apellidos', genero='$genero', fecha_nacimiento='$fecha_nacimiento', altura='$altura', peso='$peso', email='$email', usuario='$usuario' WHERE id='$id'";
        }

        if (mysqli_query($conexion, $sql)) {
            echo "Usuario actualizado correctamente";
        } else {
            echo "Error al actualizar usuario: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
        header("Location: ../admin/administracion.php");
        exit();
    }
} else {
    echo "No se recibieron datos por POST.";
}
?>

