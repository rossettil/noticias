<?php
@session_start();
session_destroy();
header("Location:   ../../views/session/login.php");
exit();
?>