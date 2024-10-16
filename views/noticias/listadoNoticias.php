<?php
@session_start();
include("../../includes/db.php");

//  Filtro
$filtros = isset($_GET['filtro']) ? $_GET['filtro'] : [];

//  Consulta default
$query = "SELECT * FROM noticias ORDER BY id DESC"; // Consulta por defecto

//  Consulta filtros
if (!empty($filtros)) {
    $filtros_str = implode(",", array_map('intval', $filtros));
    $query = "SELECT * FROM noticias WHERE id_categoria IN ($filtros_str) ORDER BY id DESC";
}

$resultado = $conn->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
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
    <link rel="stylesheet" href="../../styles/style.css?v=1.5">
</head>
<body>
    <?php include("../../includes/navbar.php"); ?>
    <div class="container div-noticias">
        <div class="sidebar">
            <?php if (isset($_SESSION['id'])) { ?>
                <div class="a-noticias">
                    <a href="subirNoticia.php" class="btn-noticia">Subir noticia</a>
                </div>
            <hr>
            <?php } ?>
            <div class="filtros">
                <h3>Filtros</h3>
                <form action="" method="get">
                    <div class="lista-filtros">
                        <input type="checkbox" name="filtro[]" value="1" id="accidentes">
                        <label for="accidentes">Accidentes</label>
                        <br>
                        <input type="checkbox" name="filtro[]" value="2" id="economia">
                        <label for="economia">Economia</label>
                        <br>
                        <input type="checkbox" name="filtro[]" value="3" id="politica">
                        <label for="politica">Politica</label>
                        <br>
                        <input type="checkbox" name="filtro[]" value="4" id="tecnologia">
                        <label for="tecnologia">Tecnologia</label>
                        <br>
                        <input type="checkbox" name="filtro[]" value="5" id="otros">
                        <label for="otros">Otros</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
                </form>
            </div>
        </div>
        <div class="menu-noticias">
        <?php while ($fila = $resultado->fetch_object()) { ?>
            <div class="noticia">
                <div class="titulo">
                    <h1><?php echo $fila->titulo;?></h1>
                </div>
                <div class="imagen">
                    <img src="../../controllers/noticias/<?php echo $fila->imagen;?>" alt="noticia">
                </div>
                <div class="descripcion">
                    <p><?php echo $fila->descripcion;?></p>
                </div>
                <div class="botones">
                    <a href="verNoticia.php?id=<?php echo $fila->id;?>" class="btn-ver-noticia">Ver Noticia</a>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) { ?>
                        <a href="../../controllers/noticias/eliminarNoticia.php?id=<?php echo $fila->id?>"><span class="material-symbols-outlined eliminar">delete</span></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>