<?php
if (!empty($_POST['id'])) {
    $imageId = $_POST['id'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "negocio");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener la información de la imagen
    $sql = "SELECT ruta FROM imagenes WHERE id = $imageId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $row['ruta'];

        // Eliminar el archivo de imagen
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Eliminar la imagen de la base de datos
        $sql = "DELETE FROM imagenes WHERE id = $imageId";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("status" => "success", "message" => "Imagen eliminada correctamente."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error al eliminar de la base de datos: " . $conn->error));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Imagen no encontrada."));
    }

    $conn->close();
} else {
    echo json_encode(array("status" => "error", "message" => "ID de imagen no proporcionado."));
}
?>