<?php
session_start();
include 'conexion_backend.php';

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$email' AND contrasena='$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
    $fila = mysqli_fetch_assoc($validar_login);
    $id_usuario = $fila['id'];
    $id_roles = $fila['id_roles'];

    $_SESSION['usuario'] = $email;
    $_SESSION['id_usuario'] = $id_usuario; 

    if ($id_roles == 1) {
        header("Location: ../admin/administracion.php");
    } elseif ($id_roles == 2) {
        header("Location: ../html/main.php");
    } else {
        echo '<script>
        alert("Error al iniciar sesión, rol no reconocido.");
        window.location = "../html/login.php"; 
        </script>';
    }
    exit();
} else {
    echo '<script>
    alert("Error al iniciar sesión, el usuario no existe. Por favor, verifique sus credenciales.");
    window.location = "../html/login.php"; 
    </script>';
    exit();
}

mysqli_close($conexion);
?>

