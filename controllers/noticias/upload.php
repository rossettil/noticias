<?php
include("../../includes/db.php");
include("../../controllers/session/validacionSession.php");
include("../../controllers/roles/validacionRol.php");
@session_start();

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$texto = $_POST['subtitulo'];
$id_categoria = $_POST['categoria'];
$id_usuario = $_SESSION['id'];

$carpetaASubir = "uploads/";
$rutaFinal = $carpetaASubir . $_FILES["imagen"]["name"];

if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFinal)) {
    echo "Archivo subido correctamente";
        $sql = "INSERT INTO noticias (titulo, descripcion, texto, id_categoria, id_usuario, imagen) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiis", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $rutaFinal);
        $stmt->execute();   
        $stmt->close();

    } else {
        echo "Error al subir el archivo";
    }
;
?>