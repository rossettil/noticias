<?php
include("../../includes/db.php");
include("../../controllers/session/validacionSession.php");
@session_start();

$id = $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = mysqli_query($conn, $sql);
$fila = mysqli_fetch_assoc($result);

$sql_noticias = "SELECT * FROM noticias WHERE id_usuario = $id";
$resultado_noticias = mysqli_query($conn, $sql_noticias);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css?v=5">
</head>
<body>
<?php include("../../includes/navbar.php"); ?>
<div class="menu-perfil">
    <div class="datos-perfil">
        <input type="hidden" id="datos-personales">
        <aside>
            <ul>
                <li id="datos-perfil-link">Datos Personales</li>
                <hr>
                <li id="noticias-perfil-link">Noticias</li>
            </ul>
        </aside>
        <div class="datos-personales">
            <h2>Datos personales</h2>
            <p><span>Nombre:</span> <?php echo $fila['nombre'];?></p>
            <p><span>Apellido:</span> <?php echo $fila['apellido'];?></p>
            <p><span>Email:</span> <?php echo $fila['email'];?></p>
            <p><span>Rol:</span> <?php $rol = $fila['rol']; $rol = ($rol == 1) ? "Super Administrador" : (($rol == 2) ? "Administrador" : "Usuario común"); echo $rol;?></p>
        </div>
        <div class="noticias-perfil">
            <h2>Noticias subidas</h2>
            <?php while ($fila_noticias = mysqli_fetch_assoc($resultado_noticias)) { ?>
                <div class="card-noticia">
                        <div class="imagen-perfil">
                            <img src="../../controllers/noticias/<?php echo $fila_noticias['imagen'];?>" alt="noticia" width="50">
                        </div>
                        <div class="titulo-perfil">
                            <?php echo $fila_noticias['titulo'];?>
                        </div>
                        <div class="a-perfil">
                            <a href="../noticias/verNoticia.php?id=<?php echo $fila_noticias['id'];?>">Ver noticia</a>
                        </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="../../styles/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>