<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../aseets/css/sty_index.css">
    <link rel="icon" href="icons/digital.png">
    <title>Go Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Administrador</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Ingrese los datos pedidos</span>
                <input type="text" placeholder="nombre">
                
                <input type="password" placeholder="Contraseña">
                <button><a href="admin1.php">Inciar</a></button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Usuario</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Ingrese los datos pedidos</span>
                <input type="text" placeholder="Nombre">
                <input type="password" placeholder="Contraseña">
                <a href="#">olvido la contraseña?</a>
                <button><a href="usuario1.php">Iniciar</a></button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido Usuario!</h1>
                    <p>Ingrese sus datos para acceder como usuario</p>
                    <button class="hidden" id="login">USUARIO</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hola Administrador!</h1>
                    <p>Registre sus credenciales para acceder como administradors</p>
                    <button class="hidden" id="register">ADMINISTRADOR</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../aseets/js/js_index.js"></script>
</body>

</html>