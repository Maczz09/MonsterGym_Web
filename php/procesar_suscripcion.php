<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'monster_gym_db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan = $_POST['plan'];
    $duration = $_POST['duration'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_usuario = $_SESSION['id_usuario']; 

    $id_tipo_membresia = 0;
    switch ($plan) {
        case 'muscle':
            $id_tipo_membresia = 1;
            break;
        case 'monster':
            $id_tipo_membresia = 2;
            break;
        case 'prime':
            $id_tipo_membresia = 3;
            break;
    }

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = "SELECT fecha_fin FROM miembros WHERE id_usuario = ? ORDER BY fecha_fin DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($ultima_fecha_fin);
    $stmt->fetch();
    $stmt->close();

    if ($ultima_fecha_fin) {
        $fecha_inicio = $ultima_fecha_fin;
        $fecha_fin_date = new DateTime($fecha_inicio);

        if ($duration == 1) {
            $fecha_fin_date->modify('+1 month');
        } elseif ($duration == 6) {
            $fecha_fin_date->modify('+6 months');
        } elseif ($duration == 12) {
            $fecha_fin_date->modify('+1 year');
        }

        $fecha_fin = $fecha_fin_date->format('Y-m-d');
    }

    $query = "INSERT INTO miembros (id_usuario, id_tipo_membresia, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $id_usuario, $id_tipo_membresia, $fecha_inicio, $fecha_fin);

    if ($stmt->execute()) {
        echo '<script>alert("Suscripción registrada correctamente."); window.location.href = "../html/main.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '"); window.location.href = "../html/main.php";</script>';
    }

    $stmt->close();
    $conn->close();
}
?>


<?php