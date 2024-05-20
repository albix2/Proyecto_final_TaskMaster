<?php
include "../login/conexion.php";
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../index.php");
    exit;
}

date_default_timezone_set("America/Bogota");
setlocale(LC_ALL, "es_ES");
include "../conexion/config.php";
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL, "es_ES");

$usuario = $_SESSION['nombre'];
$correo_electronico = $_POST["correo_electronico"];
$id_evento = $_POST['idEvento'];

mysqli_select_db($con, "practicas");

// Obtener el ID del usuario
$sql2 = "SELECT id_usuario FROM usuario WHERE correo_electronico='$correo_electronico'";
$res2 = mysqli_query($con, $sql2);
$fila2 = mysqli_fetch_assoc($res2);
$usuario_compartir = $fila2['id_usuario'];

// Verificar si ya se compartió el evento con el mismo correo electrónico
$sql_verificar = "SELECT COUNT(*) AS total FROM usuario_evento WHERE id_evento='$id_evento' AND id_usuario='$usuario_compartir'";
$res_verificar = mysqli_query($con, $sql_verificar);
$fila_verificar = mysqli_fetch_assoc($res_verificar);
$total_compartido = $fila_verificar['total'];

if ($total_compartido > 0) {
    // Si ya se compartió el evento con el mismo correo electrónico, redirigir con un mensaje de error
    header("Location: tareas.php?error=1");
    exit;
}

// Insertar evento en la base de datos
$insert2 = "INSERT INTO usuario_evento (id_evento, id_usuario) VALUES ('$id_evento', '$usuario_compartir')";
$resultadoInsert2 = mysqli_query($con, $insert2);

if ($resultadoInsert2) {
    header("Location: tareas.php");
} else {
    echo "Error al insertar el evento: " . mysqli_error($con);
}
?>
