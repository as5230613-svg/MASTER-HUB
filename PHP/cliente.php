<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("conexion.php");

// VALIDAR SESIÓN
if(!isset($_SESSION['correo'])){
    header("Location: ../login.php");
    exit();
}

// DATOS DEL USUARIO
$nombre = $_SESSION['usuario'] ?? 'Usuario';
$rol = $_SESSION['rol'] ?? 'Cliente';
$id_usuario = $_SESSION['id_usuario'] ?? 0;

/* ==========================================
   VIDEOS VISTOS
========================================== */
$sql_vistos = "SELECT COUNT(*) AS total 
FROM historial_videos 
WHERE id_usuario = '$id_usuario'";

$result_vistos = mysqli_query($conexion, $sql_vistos);
$videos_vistos = mysqli_fetch_assoc($result_vistos)['total'] ?? 0;

/* ==========================================
   FAVORITOS
========================================== */
$sql_favoritos = "SELECT COUNT(*) AS total 
FROM favoritos 
WHERE id_usuario = '$id_usuario'";

$result_favoritos = mysqli_query($conexion, $sql_favoritos);
$favoritos = mysqli_fetch_assoc($result_favoritos)['total'] ?? 0;

/* ==========================================
   HORAS VISTAS
========================================== */
$sql_horas = "SELECT SUM(duracion) AS total 
FROM historial_videos 
WHERE id_usuario = '$id_usuario'";

$result_horas = mysqli_query($conexion, $sql_horas);
$horas = mysqli_fetch_assoc($result_horas)['total'] ?? 0;

/* convertir minutos a horas */
$horas = round($horas / 60, 1);

/* ==========================================
   COLECCIONES
========================================== */
$sql_colecciones = "SELECT COUNT(*) AS total 
FROM colecciones 
WHERE id_usuario = '$id_usuario'";

$result_colecciones = mysqli_query($conexion, $sql_colecciones);
$colecciones = mysqli_fetch_assoc($result_colecciones)['total'] ?? 0;

?>
