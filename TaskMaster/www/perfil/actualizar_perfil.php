<?php
include "../login/conexion.php";

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include "../conexion/config.php";

$id_usuario = $_SESSION['id_usuario'];

// Obtener el ID del usuario



$idEvento = $_POST['idEvento'];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ciudad = $_POST["ciudad"];


$correo = $_POST["correo"];



// echo $nombreArchivo;
// echo $directorioSubida;
// Consulta SQL para actualizar el evento

    // Si se selecciona una nueva imagen
    $actualizar_evento = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', ciudad = '$ciudad', correo_electronico = '$correo' WHERE id_usuario='".$idEvento."'";

// Si el estado es "Pendiente", establece la fecha de finalización como NULL

//echo $actualizar_evento;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: perfil.php");
?>
