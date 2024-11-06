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

// Verificar el valor del ID recibido
var_dump($id);  // Esto imprimirá el valor de $id que se está recibiendo del formulario

echo "<br>-----------------------------";
// Asegúrate de que el ID esté presente y sea un número válido
if (!isset($id) || !is_numeric($id)) {
    exit("El ID proporcionado no es válido.");
}

echo "ID de la noticia: $id <br>";  // Verifica si el id se está pasando correctamente


// Consultar la noticia actual desde la base de datos
$sql = "SELECT titulo, descripcion, texto, id_categoria FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$noticia = $resultado->fetch_assoc();
$stmt->close();

// Verificar si se encontró la noticia
if (!$noticia) {
    exit("No se encontró la noticia con el ID proporcionado.");
}

// Comparar los valores actuales con los nuevos
if ($noticia['titulo'] === $titulo && $noticia['descripcion'] === $descripcion && $noticia['texto'] === $texto && $noticia['id_categoria'] == $id_categoria) {
    exit("No hay cambios en los datos. La actualización no se realizará.");
}

// Actualizar los datos de la noticia
$sql = "UPDATE noticias SET titulo = ?, descripcion = ?, texto = ?, id_categoria = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    exit("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("sssii", $titulo, $descripcion, $texto, $id_categoria, $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: ../../views/noticias/verNoticia.php?id=$id");
    } else {
        echo "No se realizaron cambios o ocurrió un error.";
    }
} else {
    echo "Error en la ejecución de la consulta: " . $stmt->error;
}

$stmt->close();

?>