<?php
session_start();
include 'conexion_backend.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$genero = $_POST['genero'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$verificar_email = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");

if (mysqli_num_rows($verificar_email) > 0) {
    echo '<script>
    alert("Este correo ya está registrado, intente con uno distinto");
    window.location = "../html/login.php";
    </script>';
    exit();
}

$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '<script>
    alert("Este usuario ya está registrado, intente con uno distinto");
    window.location = "../html/login.php";
    </script>';
    exit();
}

$query = "INSERT INTO usuarios (nombres, apellidos, genero, fecha_nacimiento, altura, peso, email, usuario, contrasena, id_roles) 
VALUES ('$nombres', '$apellidos', '$genero', '$fecha_nacimiento', '$altura', '$peso', '$email', '$usuario', '$contrasena', 1)";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script>
    alert("Usuario registrado exitosamente");
    window.location = "../html/login.php";
    </script>';
} else {
    echo '<script>
    alert("Intentar registro nuevamente");
    window.location = "../html/login.php";
    </script>';
}

mysqli_close($conexion);
?>
