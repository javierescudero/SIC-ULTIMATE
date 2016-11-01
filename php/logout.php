<?php 
session_start();
unset($_SESSION['session_nombre_usuario']);
session_destroy();
header("location:../index.php");
?>
