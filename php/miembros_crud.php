<?php
include("../php/conexion_backend.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $id_usuario = $_POST['id_usuario'];
        $id_tipo_membresia = $_POST['id_tipo_membresia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $query = "INSERT INTO miembros (id_usuario, id_tipo_membresia, fecha_inicio, fecha_fin) VALUES ('$id_usuario', '$id_tipo_membresia', '$fecha_inicio', '$fecha_fin')";
        mysqli_query($conexion, $query);
        header("Location: ../admin/manejo_membresias.php");
    } elseif ($action == 'edit') {
        $id_miembros = $_POST['id_miembros'];
        $id_usuario = $_POST['id_usuario'];
        $id_tipo_membresia = $_POST['id_tipo_membresia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $query = "UPDATE miembros SET id_usuario='$id_usuario', id_tipo_membresia='$id_tipo_membresia', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin' WHERE id_miembros='$id_miembros'";
        mysqli_query($conexion, $query);
        header("Location: ../admin/manejo_membresias.php");
    } elseif ($action == 'delete') {
        $id_miembros = $_POST['id_miembros'];

        $query = "DELETE FROM miembros WHERE id_miembros='$id_miembros'";
        mysqli_query($conexion, $query);
        header("Location: ../admin/manejo_membresias.php");
    }
}
?>
