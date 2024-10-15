<?php
$targetDir = "../uploads/"; // Directorio donde se guardarán las imágenes
$response = array();

// Verificar si hay archivos subidos
if (!empty($_FILES['image'])) {
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "negocio");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Procesar la imagen
    $file = $_FILES['image'];
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Subir la imagen al servidor
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        // Guardar la ruta de la imagen en la base de datos
        $sql = "INSERT INTO imagenes (nombre, ruta) VALUES ('$fileName', '$targetFilePath')";
        if ($conn->query($sql) === TRUE) {
            $response = array("status" => "success", "message" => "$fileName subida correctamente.");
        } else {
            $response = array("status" => "error", "message" => "Error al guardar en la base de datos: " . $conn->error);
        }
    } else {
        $response = array("status" => "error", "message" => "Error al subir $fileName.");
    }

    $conn->close();
} else {
    $response = array("status" => "error", "message" => "No se recibieron archivos.");
}

// Devolver respuesta en formato JSON
echo json_encode($response);
?>