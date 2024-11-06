<?php
include("../../includes/db.php");
$id = $_GET["id"];

//  Consulta
$query = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

//  Redireccionar
header("Location:   ../../views/usuarios/panelDeUsuarios.php");
exit();
?>