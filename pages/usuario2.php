<?php
$pageTitle = "GoDigital";
include 'includes/menu_usuario.php';
?>
    <div class="gallery">
    <?php
    $conn = new mysqli("localhost", "root", "", "negocio");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM imagenes ORDER BY fecha_subida DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $image_id = $row['id'];
            echo '<div class="image-item">';
            echo '<img src="' . $row['ruta'] . '" alt="' . $row['nombre'] . '" onclick="openModal(\'' . $row['ruta'] . '\', ' . $image_id . ')">';
            echo '</div>';
        }
    } else {
        echo '<p>No se han subido imágenes aún.</p>';
    }

    $conn->close();
    ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="">
        
        <!-- Botón de "me gusta" dentro del modal -->
        <button id="likeBtn" class="like-btn" data-id="" onclick="toggleLike(this)">❤️</button>
    </div>
</div>

<script>
let zoomLevel = 1;

function openModal(imageSrc, imageId) {
    document.getElementById("modalImage").src = imageSrc;
    document.getElementById("myModal").style.display = "flex";
    zoomLevel = 1;
    document.getElementById("modalImage").style.transform = "scale(" + zoomLevel + ")";
    document.getElementById("likeBtn").setAttribute('data-id', imageId);
    document.getElementById("modalImage").addEventListener("wheel", handleWheel);
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
    document.getElementById("modalImage").style.transform = "scale(1)";
    document.getElementById("modalImage").removeEventListener("wheel", handleWheel);
}

function toggleLike(button) {
    const imageId = button.getAttribute('data-id');

    fetch('like_image.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'image_id=' + imageId
    })
    .then(response => response.json())
    .then(data => {
        if (data.liked) {
            button.classList.add('liked');
        } else {
            button.classList.remove('liked');
        }
    })
    .catch(error => console.error('Error:', error));
}

function handleWheel(event) {
    event.preventDefault();

    const rect = document.getElementById("modalImage").getBoundingClientRect();
    const offsetX = event.clientX - rect.left;
    const offsetY = event.clientY - rect.top;

    const scaleFactor = 0.2;

    if (event.deltaY < 0) {
        zoomLevel += scaleFactor;
    } else {
        if (zoomLevel > 1) {
            zoomLevel -= scaleFactor;
        }
    }

    document.getElementById("modalImage").style.transform = `scale(${zoomLevel})`;
}
</script>

<?php include 'includes/menu_usuario1.php'; ?>