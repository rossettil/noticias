<?php
include("../../includes/db.php");
$id = $_GET["id"];

//  Consulta
$query = $conn->prepare("DELETE FROM noticias WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

//  Redireccionar
header("Location:   ../../views/noticias/listadoNoticias.php");
exit();
?>