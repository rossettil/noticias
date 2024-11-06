<?php
session_start();
include("../../includes/db.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location:   ../noticias/listadoNoticias.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_object();
    } else {
        die("Usuario no encontrado");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    $nombre = $conn->real_escape_string($nombre);
    $apellido = $conn->real_escape_string($apellido);
    $email = $conn->real_escape_string($email);
    $rol = (int)$rol;

    $update_sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email', rol = $rol WHERE id = $id_usuario";
    
    if ($conn->query($update_sql)) {
        header("Location: panelDeUsuarios.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css?v=4">
    <style>
        input, select, option {
            color: darkslategray;
        }

        .btn-updt {
            background-color: darkslategray;
            border: 1px solid darkslategray;
        }

        .btn-updt:hover {
            background-color: rgb(61, 102, 102);
            border: 1px solid rgb(61, 102, 102);
        }

        .btn-updt:active {
            border-color: rgb(61, 102, 102) !important;
            outline: none !important;
            background-color: rgb(82, 153, 153) !important;
        }
    </style>
</head>
<body>
    <?php include("../../includes/navbar.php"); ?>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form action="editarUsuario.php?id=<?php echo $usuario->id ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario->apellido ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario->email ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-control" id="rol" name="rol">
                    <option value="1" <?php echo ($usuario->rol == 1) ? 'selected' : ''; ?>>Super Administrador</option>
                    <option value="2" <?php echo ($usuario->rol == 2) ? 'selected' : ''; ?>>Administrador</option>
                    <option value="3" <?php echo ($usuario->rol == 3) ? 'selected' : ''; ?>>Usuario común</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-updt">Actualizar</button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../styles/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
