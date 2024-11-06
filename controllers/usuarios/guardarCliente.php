<?php
require("../../includes/db.php");

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$password = $_POST["password"];
$id_rol = 3;

//  Consulta
$query = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ? ,?, ?)");
$query->bind_param("ssssi", $nombre, $apellido, $email, $password, $id_rol);
$query->execute();

//  Redireccionar al login
header("Location:   ../../views/session/login.php");
exit();
?>