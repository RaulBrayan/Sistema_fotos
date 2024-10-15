<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Administrador</title>

    <link rel="stylesheet" href="../aseets/css/admin.css">
    <link rel="stylesheet" href="../aseets/css/sti_archivo.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>

<style>
        /* Estilo para la animación de carga */
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            display: none;
            margin: auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

<body id="body">
    
    <header>
        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>
            
        </div>
        <a href="index.php" class="cesion">Cerrar Secion</a>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img src="/icons/digital.png" alt="Go Digital">
            
            <h4>Go Digital</h4>
        </div>

        <div class="options__menu">	

            <a href="admin1.php" class="selected">
                <div class="option">
                    <i class="fas fa-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <a href="admin2.php">
                <div class="option">
                    <i class="far fa-file" title="Portafolio"></i>
                    <h4>Archivos</h4>
                </div>
            </a>
            
            <a href="admin3.php">
                <div class="option">
                    <i class="fas fa-video" title="Cursos"></i>
                    <h4>Cursos</h4>
                </div>
            </a>

            <a href="admin4.php">
                <div class="option">
                    <i class="far fa-sticky-note" title="Blog"></i>
                    <h4>Blog</h4>
                </div>
            </a>

            <a href="admin5.php">
                <div class="option">
                    <i class="far fa-id-badge" title="Contacto"></i>
                    <h4>Usuarios</h4>
                </div>
            </a>

            <a href="admin6.php">
                <div class="option">
                    <i class="far fa-address-card" title="Nosotros"></i>
                    <h4>Administradores</h4>
                </div>
            </a>

        </div>

    </div>

    <main>
        <h1>Archivos</h1><br>
        <!-- Input para seleccionar la carpeta -->
    <input type="file" title="Selecciona una carpeta" id="folderInput" webkitdirectory multiple>
    <button onclick="uploadImages()">Subir Imágenes</button>
    <button onclick="deleteAllImages()">Borrar Todo</button> <!-- Botón de borrar todo -->
    <div id="loader" class="loader"></div>

    <hr>

    <!-- Tabla de registro de imágenes -->
    <h2>Registro de Imágenes Subidas</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la Imagen</th>
                <th>Fecha de Subida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "negocio");
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM imagenes ORDER BY fecha_subida DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['fecha_subida'] . '</td>';
                    echo '<td><button onclick="deleteImage(' . $row['id'] . ')">Eliminar</button></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No se han subido imágenes aún.</td></tr>';
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <br>
    <button onclick="window.location.reload();">Actualizar Registro</button>

    <hr>

    <!-- Enlace a la galería de imágenes -->
    <a href="galeria.php">Ver Galería de Imágenes</a>

    <script>
        let selectedFiles = [];
        let currentIndex = 0;

        // Detectar los archivos seleccionados
        document.getElementById('folderInput').addEventListener('change', function(event) {
            selectedFiles = Array.from(event.target.files).filter(file => {
                return file.type.startsWith('image/');
            });

            if (selectedFiles.length === 0) {
                alert('No se seleccionaron imágenes.');
            } else {
                console.log(`${selectedFiles.length} imágenes seleccionadas.`);
            }
        });

        // Función para subir las imágenes una por una
        function uploadImages() {
            if (selectedFiles.length > 0) {
                document.getElementById('loader').style.display = 'block';
                uploadSingleImage(currentIndex);
            } else {
                alert('No hay imágenes seleccionadas para subir.');
            }
        }

        // Subir una imagen a la vez
        function uploadSingleImage(index) {
            if (index < selectedFiles.length) {
                let formData = new FormData();
                formData.append('image', selectedFiles[index]);

                fetch('../php/envi_datos.php', { // Ruta al script PHP
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    currentIndex++;
                    uploadSingleImage(currentIndex);
                })
                .catch(error => {
                    console.error('Error al subir imágenes:', error);
                });
            } else {
                document.getElementById('loader').style.display = 'none';
                alert('Las imágenes fueron subidas correctamente.');
                window.location.reload();
            }
        }

        // Función para eliminar una imagen
        function deleteImage(imageId) {
            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                fetch('../php/eliminar_imagen.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${imageId}`
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error al eliminar la imagen:', error);
                });
            }
        }

        // Función para borrar todas las imágenes
        function deleteAllImages() {
            if (confirm('¿Estás seguro de que deseas eliminar todas las imágenes?')) {
                fetch('../php/eliminar_todas_imagenes.php', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error al eliminar todas las imágenes:', error);
                });
            }
        }
    </script>
        
    </main>

    <script src="../aseets/js/admin.js"></script>
</body>
</html>