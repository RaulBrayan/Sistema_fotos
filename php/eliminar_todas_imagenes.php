<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "negocio");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener todas las imágenes
$sql = "SELECT ruta FROM imagenes";
$result = $conn->query($sql);

// Eliminar cada imagen del servidor
while ($row = $result->fetch_assoc()) {
    $imagePath = $row['ruta'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// Eliminar todas las imágenes de la base de datos
$sql = "DELETE FROM imagenes";
if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success", "message" => "Todas las imágenes fueron eliminadas."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al eliminar las imágenes de la base de datos."));
}

$conn->close();
?>