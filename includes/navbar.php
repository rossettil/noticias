<?php
@session_start();
include("db.php");

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $result = $conn->query($sql);
    $fila = $result->fetch_assoc();
    
    $nombreUsuario = $fila['nombre'];
    $apellidoUsuario = $fila['apellido'];
    $rol = $fila['rol'];
}
?>
<nav class="navbar">
    <ul class="ul-navbar">
        <li><a href="../inicio/index.php" class="nav-link">Inicio</a></li>
        <li><a href="../noticias/listadoNoticias.php" class="nav-link">Noticias</a></li>

        <?php if (isset($_SESSION["id"])) { ?>
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $nombreUsuario . " " . $apellidoUsuario; ?>
                </a>
                <ul class="dropdown-menu">
                    <?php if ($_SESSION['rol'] == 1) { ?>
                        <li><a href="../usuarios/perfil.php?id=<?php echo $fila['id'];?>" class="dropdown-item">Mi perfil</a></li>
                        <li><a href="../usuarios/panelDeUsuarios.php" class="dropdown-item">Panel de usuarios</a></li>
                        <li><a href="../../controllers/session/operacionLogOut.php" class="dropdown-item">Cerrar sesión</a></li>
                    <?php } else {?>
                    <li><a href="../usuarios/perfil.php?id=<?php echo $fila['id'];?>" class="dropdown-item">Mi perfil</a></li>
                    <li><a href="../../controllers/session/operacionLogOut.php" class="dropdown-item">Cerrar sesión</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } else { ?>
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">¿Nuevo?</a>
                <ul class="dropdown-menu">
                    <li><a href="../session/login.php" class="dropdown-item">Iniciar sesión</a></li>
                    <li><a href="../usuarios/nuevoCliente.php" class="dropdown-item">Registrarse</a></li>
                </ul>
            </li>
        <?php } ?>
    </ul>
</nav>
