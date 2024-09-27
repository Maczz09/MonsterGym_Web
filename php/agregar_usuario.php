<?php
session_start();
include 'conexion_backend.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_roles = $_POST['id_roles'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contrasena = hash('sha512', $_POST['contrasena']);

    $check_sql = "SELECT * FROM usuarios WHERE email='$email' OR usuario='$usuario'";
    $result = mysqli_query($conexion, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('El nombre de usuario o el email ya están en uso.');
                window.location.href='../admin/administracion.php';
              </script>";
    } else {
        $sql = "INSERT INTO usuarios (id_roles, nombres, apellidos, genero, fecha_nacimiento, altura, peso, email, usuario, contrasena) VALUES ('$id_roles', '$nombres', '$apellidos', '$genero', '$fecha_nacimiento', '$altura', '$peso', '$email', '$usuario', '$contrasena')";

        if (mysqli_query($conexion, $sql)) {
            echo "Nuevo usuario agregado correctamente";
        } else {
            echo "Error al agregar usuario: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
        header("Location: ../admin/administracion.php");
        exit();
    }
} else {
    echo "No se recibieron datos por POST.";
}
?>
