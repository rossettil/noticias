<?php
session_start();
include("../../includes/db.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location:   ../noticias/listadoNoticias.php");
    exit();
}

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css?v=4">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include("../../includes/navbar.php"); ?>
<div class="container menu-panelUsuarios">
    <h2>Panel de usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_object()) { ?>
            <tr>
                <td><?php echo $fila->id ?></td>
                <td><?php echo $fila->nombre ?></td>
                <td><?php echo $fila->apellido ?></td>
                <td><?php echo $fila->email ?></td>
                <td>
                    <?php 
                        if ($fila->rol == 1) { 
                            echo "Super Administrador"; 
                        } elseif ($fila->rol == 2) { 
                            echo "Administrador"; 
                        } else { 
                            echo "Usuario común"; 
                        }
                    ?>
                </td>
                <td>
                    <a href="editarUsuario.php?id=<?php echo $fila->id; ?>">
                        <span class="material-symbols-outlined editar">edit</span>
                    </a>
                    <a href="../../controllers/usuarios/eliminarUsuario.php?id=<?php echo $fila->id?>" onclick="confirmarEliminacionUsuario(event)">
                        <span class="material-symbols-outlined eliminar">delete</span>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../styles/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>