<?php
include("../../includes/db.php");
include("../../controllers/session/validacionSession.php");
include("../../controllers/roles/validacionRol.php");
@session_start();

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['texto'];
$texto = $_POST['subtitulo'];
$id_categoria = $_POST['categoria'];

$carpetaASubir = "uploads/";

$sql = "SELECT imagen FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$noticia = $resultado->fetch_assoc();

if (!$noticia) {
    exit();
}

$rutaFinal = $noticia['imagen'];

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
    $rutaFinal = $carpetaASubir . $_FILES["imagen"]["name"];
    if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFinal)) {
        exit("Error al subir el archivo.");
    }
}

$sql = "UPDATE noticias SET titulo = ?, texto = ?, descripcion = ?, id_categoria = ?, imagen = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssisi", $titulo, $descripcion, $texto, $id_categoria, $rutaFinal, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location:   ../../views/noticias/verNoticia.php?id=$id");
} else {
    echo "No se realizaron cambios o ocurrió un error.";
}

$stmt->close();
?>  