<?php
include("../../includes/db.php");
include("../../controllers/session/validacionSession.php");
@session_start();
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
    <?php include("../../includes/navbar.php") ?>
    <form method="POST" action="../../controllers/noticias/upload.php" enctype="multipart/form-data" class="form-noticia">
        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo de la noticia</label>
            <input type="titulo" id="titulo" name="titulo" class="form-control input-subirNoticia" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="subtitulo" class="form-label">Subtitulo de la noticia</label>
            <input type="text" id="subtitulo" name="subtitulo" class="form-control input-subirNoticia">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion de la noticia</label>
            <textarea name="descripcion" id="descripcion" class="form-control input-subirNoticia" placeholder="Describe la noticia completa"></textarea>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria de la noticia</label>
            <select id="categoria" name="categoria" class="form-select input-subirNoticia" aria-label="Floating label select example">
                <option class="input-subirNoticia" selected>Selecciona una categoria</option>
                <option class="input-subirNoticia" value="1">Accidentes</option>
                <option class="input-subirNoticia" value="2">Economia</option>
                <option class="input-subirNoticia" value="3">Politica</option>
                <option class="input-subirNoticia" value="4">Tecnologia</option>
                <option class="input-subirNoticia" value="5">Otros</option>
            </select>
        </div>
        <br>
        <div class="input-group mb-3">
            <input type="file" class="form-control input-subirNoticia" name="imagen" id="imagen">
            <label class="input-group-text" for="imagen">Cargar imagen</label>
        </div>
        <br>
        <input type="hidden" name="id_oculto" id="id_oculto" value="<?php echo $_SESSION['id'];?>">
        <input type="submit" value="Subir noticia" class="btn-subirNoticia">
    </form>
    <?php include("../../includes/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>