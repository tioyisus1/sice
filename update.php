<?php
$servername = "localhost";  // Cambia a tu servidor
$username = "root";   // Cambia al nombre de usuario de tu base de datos
$password = ""; // Cambia a tu contraseña
$dbname = "DBNAME"; // Cambia al nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del ESP32 (estado y id)
if (isset($_GET['estado']) && isset($_GET['id'])) {
    $estado = intval($_GET['estado']); // Estado del sensor (0 o 1)
    $id = intval($_GET['id']); // ID del sensor (1, 2, 3, ...)

    // Actualizar el estado del sensor en la base de datos
    $sql = "UPDATE estados SET estado = $estado, fecha_hora = NOW() WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Estado actualizado correctamente para ESP32 con ID $id";
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
} else {
    echo "No se recibió ningún dato";
}

$conn->close();
?>
