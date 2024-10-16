<?php
$conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_errno) {
    echo "Error al conectar a MySQL: (" . $mysqli->connect_errno . " ) " . $mysqli->connect_error;
}
?>