<?php
session_start();
include 'conexion_backend.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id='$id'";

    if (mysqli_query($conexion, $sql)) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar usuario: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
    header("Location: ../admin/administracion.php");
    exit();
} else {
    echo "No se recibieron datos por POST.";
}
?>
