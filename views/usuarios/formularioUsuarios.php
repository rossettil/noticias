<?php
include("../../includes/db.php");
include("../../controllers/session/validacionSession.php");
include("../../controllers/roles/validacionRol.php");
@session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $resultado = $query->get_result();
    $usuario = $resultado->fetch_object();
} else {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="scroll-over">
<?php include("../../includes/navbar.php");?>
    <form class="form-user" action="../../controllers/usuarios/operacionesUsuarios.php?operacion=<?php echo (isset($_GET["id"])) ? "editar" : "nuevo" ?>" method="POST">
        <?php if (isset($_GET["id"])) { ?>
        <h1>Editar usuario</h1>
        <?php } else { ?>
        <h1>Nuevo usuario</h1>
        <?php } ?>
        <?php if (isset($_GET["id"])) { ?>
        <label>ID</label>
        <input type="number" name="id" value="<?php echo $usuario->id?>" readonly><br>
        <?php } ?>

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo (isset($_GET["id"])) ? $usuario->nombre : "" ?>"><br>

        <label>Apellido</label>
        <input type="text" name="apellido" value="<?php echo (isset($_GET["id"])) ? $usuario->apellido : "" ?>"><br>

        <label>E-mail</label>
        <input type="email" name="email" value="<?php echo (isset($_GET["id"])) ? $usuario->email : "" ?>"><br>

        <label>Contraseña</label>
        <input type="text" name="password" value="<?php echo (isset($_GET["id"])) ? $usuario->password : "" ?>"><br>

        <label>Rol:</label>
        <select name="id_rol" id="id_rol">
            <?php
            if ($usuario->id_rol=="1") { ?>
                <option value="1">Administrador</option>
                <option value="2">Empleado</option>
            <?php } else { ?>
                <option value="2">Empleado</option>
                <option value="1">Adminsitrador</option>
            <?php } ?>
        </select>
        <br><br>
        <?php if (isset($_GET["id"])) { ?>
        <input type="submit" value="Editar">
        <?php } else { ?>
        <input type="submit" value="Añadir">
        <?php } ?>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>