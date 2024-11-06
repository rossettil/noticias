<?php
include("../../includes/db.php");

$id = $_GET['id'];

$resultado = $conn->query("SELECT n.*, u.nombre AS nombre_usuario, u.apellido AS apellido_usuario, c.nombre AS nombre_categoria FROM noticias n JOIN usuarios u ON n.id_usuario = u.id JOIN categorias c ON n.id_categoria = c.id WHERE n.id = $id;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css?v=1">
</head>
<body>
    <?php include("../../includes/navbar.php");?>
    <?php while ($fila = $resultado->fetch_object()) { ?>
    <div class="detalle-noticia">
        <div class="botones-verNoticia">
            <small>Publicado por: <?php echo $fila->nombre_usuario . " " . $fila->apellido_usuario;?></small>
            <small>Categoria: <?php echo $fila->nombre_categoria;?></small>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] <= 2) { ?>
                <a href="editarNoticia.php?id=<?php echo $fila->id?>"><span class="material-symbols-outlined">edit</span></a>
            <?php } ?>
        </div>
        <h1><?php echo $fila->titulo;?></h1>
        <img src="../../controllers/noticias/<?php echo $fila->imagen;?>" alt="imagen">
        <h3><?php echo $fila->texto;?></h3>
        <p><?php echo $fila->descripcion;?></p>

    </div>
    <?php } ?>
    <?php include("../../includes/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>