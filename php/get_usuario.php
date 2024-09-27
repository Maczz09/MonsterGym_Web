<?php
include 'conexion_backend.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'Usuario no encontrado']);
    }

    mysqli_close($conexion);
} else {
    echo json_encode(['error' => 'No se proporcionó un ID de usuario']);
}
?>