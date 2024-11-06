<?php
@session_start();
include("../../includes/db.php");

//  Filtro
$filtros = isset($_GET['filtro']) ? $_GET['filtro'] : [];
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

//  Consulta default
$query = "SELECT * FROM noticias WHERE 1"; // Consulta por defecto

//  Consulta buscar
if (!empty($buscar)) {
    $buscar = $conn->real_escape_string($buscar); 
    $query .= " AND (titulo LIKE '%$buscar%' OR texto LIKE '%$buscar%')";
}

//  Consulta filtros
if (!empty($filtros)) {
    $filtros_str = implode(",", array_map('intval', $filtros));
    $query .= " AND id_categoria IN ($filtros_str)";
}

$query .= " ORDER BY id DESC";

$resultado = $conn->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/style.css?v=8">
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
            <form action="" method="get">
                <input type="search" name="buscar" id="buscar" placeholder="Buscar noticias">
                <button type="submit" class="btn btn-primary mt-2 btn-listado-noticias">Buscar</button>
            </form>
            <hr>
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
                    <button type="submit" class="btn btn-primary mt-2 btn-listado-noticias">Filtrar</button>
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
                    <p><?php echo $fila->texto;?></p>
                </div>
                <div class="botones">
                    <a href="verNoticia.php?id=<?php echo $fila->id;?>" class="btn-ver-noticia">Ver Noticia</a>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] <= 2) { ?>
                        <a href="../../controllers/noticias/eliminarNoticia.php?id=<?php echo $fila->id?>" onclick="confirmarEliminacion(event)"><span class="material-symbols-outlined eliminar">delete</span></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <br>
    <?php include("../../includes/footer.php"); ?>
    <script src="../../styles/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>