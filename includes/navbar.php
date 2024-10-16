<?php @session_start(); ?>
    <nav class="navbar">
        <ul class="ul-navbar">
                <li><a href="../inicio/index.php" class="nav-link">Inicio</a></li>
                <li><a href="../noticias/listadoNoticias.php" class="nav-link">Noticias</a></li>
                
                <?php if (isset($_SESSION["id"])) { ?>
                <li><a href="../../controllers/session/operacionLogOut.php" class="nav-link">Cerrar sesión</a></li>
                <?php } ?>
                <?php if (!isset($_SESSION["id"])) { ?>
                    <li><a href="../session/login.php" class="nav-link">Iniciar sesión</a></li>
                    <li><a href="../usuarios/nuevoCliente.php" class="nav-link">Registrarse</a></li>
                <?php } ?>
        </ul>
    </nav>