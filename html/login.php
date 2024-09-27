<?php

session_start();

if(isset($_SESSION['usuario'])){
    header("location: ../php/main.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Register - MonsterGym</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Poetsen+One&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="../php/login_backend.php" class="formulario__login" method="POST">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" required name="email">
                    <input type="password" placeholder="Contraseña" required name="contrasena">
                    <button>Entrar</button>
                </form>

                <!--Register-->
                <form action="../php/registro_usuario_backend.php" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombres" required name="nombres">
                    <input type="text" placeholder="Apellidos" required name="apellidos">

                    <div class="form-group">
                        <label for="genero" class="label-genero">Género:</label>
                        <select name="genero" id="genero" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <input type="date" required name="fecha_nacimiento">
                    <input type="number" placeholder="Altura (cm)" required name="altura">
                    <input type="number" placeholder="Peso (kg)" required name="peso">

                    <input type="text" placeholder="Correo Electrónico" required name="email">
                    <input type="text" placeholder="Usuario" required name="usuario">
                    <input type="password" placeholder="Contraseña" required name="contrasena">
                    <button type="submit">Registrarse</button>
                </form>


            </div>
        </div>

    </main>
    <footer>
        <a href="main.php" class="button">
            <div class="button-box">
                <span class="button-elem">
                    <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                        </path>
                    </svg>
                </span>
                <span class="button-elem">
                    <svg viewBox="0 0 46 40">
                        <path
                            d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                        </path>
                    </svg>
                </span>
            </div>
        </a>

    </footer>
    <script src="../js/login.js"></script>
</body>

</html>