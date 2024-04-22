<?php
include "../login/conexion.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión

if (!isset($_SESSION['nombre'])) { // Verifica si el usuario está autenticado
    header("Location: ../index.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
include "../conexion/config.php"; // Incluye el archivo de configuración (aunque no se usa explícitamente en este script)
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
$usuario = $_SESSION['nombre']; // Obtiene el nombre de usuario de la sesión
$correo_electronico = $_POST["correo_electronico"];
$id_evento = $_POST['idEvento'];
// Obtener el ID del usuario de la base de datos
mysqli_select_db($con, "practicas");
// $sql = "SELECT id_usuario FROM usuario WHERE nombre='$usuario'";
// $res = mysqli_query($con, $sql);
// $fila = mysqli_fetch_assoc($res);
// $id_usuario = $fila['id_usuario']; // Obtiene el ID de usuario

$sql2 = "SELECT id_usuario FROM usuario WHERE correo_electronico='$correo_electronico'";
$res2 = mysqli_query($con, $sql2);
$fila2 = mysqli_fetch_assoc($res2);
$usuario_compartir= $fila2['id_usuario'];
// Recibe los datos del formulario


// Insertar evento en la base de datos

$id_evento = $_POST['idEvento'];
// echo $id_evento;
$insert2 = "INSERT INTO usuario_evento (id_evento, id_usuario) VALUES ('$id_evento', '$usuario_compartir')";
$resultadoInsert2 = mysqli_query($con, $insert2);
// echo $insert2;

if ($resultadoInsert2) {
    header("Location: tareas.php");
} else {
    echo "Error al insertar el evento: " . mysqli_error($con);
}
?>
