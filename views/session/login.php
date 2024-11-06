<?php
require_once("../../includes/db.php");
@session_start();

//  Variables
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if (!empty($email) && !empty($password)) {
    //  Consulta
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();
    
    $usuario = $resultado->fetch_object();
    
    //  Condicion
    if ($usuario === null) {
        $error = "E-mail o contraseña incorrecto/s";
    } else {
        $_SESSION["id"] = $usuario->id;
        $_SESSION["nombre"] = $usuario->nombre;
        $_SESSION["rol"] = $usuario->rol;

        header("Location:   ../noticias/listadoNoticias.php");
        exit();
    }
}
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
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>
<body>
<?php include("../../includes/navbar.php") ?>
    <form class="form-login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit">Iniciar sesion</button>
    </form>
    <?php include("../../includes/footer.php"); ?>
</body>
</html>