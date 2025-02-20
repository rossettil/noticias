<?php
include("../../includes/db.php");

//  Variables
$id = $_GET["id"];
$sql = "SELECT * FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../styles/style.css?v=1">
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 30%;
            margin: 20px auto;
        }
        img {
            max-width: 800px;
        }

        form input, form textarea, form select, form select option, form input[type="submit"] {
            color: darkslategray;
        }
    </style>
</head>
<body>
    <?php include("../../includes/navbar.php");?>
    <form action="../../controllers/noticias/actualizarNoticia.php" method="post" enctype="multipart/form-data">
    <h1>Editar Noticia</h1>
    <?php while ($fila = $resultado->fetch_object()) { ?>
        <input type="hidden" name="id" value="<?php echo $fila->id;?>">

        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $fila->titulo; ?>">  

        <br>

        <label for="subtitulo">Subtitulo</label>
        <input type="text" name="subtitulo" id="subtitulo" value="<?php echo $fila->texto; ?>">

        <br>

        <label for="texto">Descripcion</label>
        <textarea name="texto" id="texto"><?php echo $fila->descripcion; ?></textarea> 

        <br>

        <label for="categoria" class="form-label">Categoria de la noticia</label>
        <select id="categoria" name="categoria" class="form-select input-subirNoticia" aria-label="Floating label select example">
            <option value="1" <?php if ($fila->id_categoria == 1) echo "selected"; ?>>Accidentes</option>
            <option value="2" <?php if ($fila->id_categoria == 2) echo "selected"; ?>>Economía</option>
            <option value="3" <?php if ($fila->id_categoria == 3) echo "selected"; ?>>Política</option>
            <option value="4" <?php if ($fila->id_categoria == 4) echo "selected"; ?>>Tecnología</option>
            <option value="5" <?php if ($fila->id_categoria == 5) echo "selected"; ?>>Otros</option>
        </select>

        <br>      

        <input type="submit" value="Guardar">
    <?php } ?>
    </form>
    <?php include("../../includes/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>