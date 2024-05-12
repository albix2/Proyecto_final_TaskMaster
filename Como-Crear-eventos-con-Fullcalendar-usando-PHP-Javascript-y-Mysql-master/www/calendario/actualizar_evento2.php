<?php
include "../login/conexion.php";

session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../index.php");
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include "config.php";

$usuario = $_SESSION['nombre'];

// Obtener el ID del usuario

mysqli_select_db($con, "practicas");
$sql = "SELECT id_usuario FROM usuario WHERE nombre='$usuario'";
$res = mysqli_query($con, $sql);
$fila = mysqli_fetch_assoc($res);
$id_usuario = $fila['id_usuario'];

$idEvento = $_POST['idEvento'];
$color = $_POST["color"];
$evento = $_POST["evento"];
$descripcion = $_POST["descripcion"];
$f_inicio = $_REQUEST['fecha_inicio'];
$fecha_inicio = date('Y-m-d\TH:i:s', strtotime($f_inicio));

$f_fin = $_REQUEST['fecha_fin']; 
$seteando_f_final = date('Y-m-d\TH:i:s', strtotime($f_fin));  
$fecha_fin1 = strtotime($seteando_f_final."+ 1 days");
$fecha_fin = date('Y-m-d\TH:i:s', $fecha_fin1);

$id_etiqueta = $_POST["id_etiqueta"];
$id_estado = $_POST["id_estado"];

// Validación y manejo de archivos
$directorioSubida = "../ficheros/";
$max_file_size = "5120000";
$extensionesValidas = array("jpg", "png", "gif", "pdf");

if (isset($_FILES['fotografia']) && isset($_FILES['fotografia']['name'])) {
    $errores = 0;
    $nombreArchivo = $_FILES['fotografia']['name'];
    $filesize = $_FILES['fotografia']['size'];
    $directorioTemp = $_FILES['fotografia']['tmp_name'];
    $tipoArchivo = $_FILES['fotografia']['type'];
    $arrayArchivo = pathinfo($nombreArchivo);
    $extension = strtolower($arrayArchivo['extension']);

    if (!in_array($extension, $extensionesValidas)) {
        echo "Extensión no válida";
        $errores = 1;
    }
    if ($filesize > $max_file_size) {
        echo "El archivo debe tener un tamaño inferior";
        $errores = 1;
    }

    if ($errores == 0) {
        $nombreCompleto = $directorioSubida . $nombreArchivo;
        move_uploaded_file($directorioTemp, $nombreCompleto);
    }
}
// echo $nombreArchivo;
// echo $directorioSubida;
// Consulta SQL para actualizar el evento
if ($_FILES['fotografia']['name'] != "") {
    // Si se selecciona una nueva imagen
    $actualizar_evento = "UPDATE eventoscalendar SET evento = '$evento', descripcion = '$descripcion', color_evento = '$color', fecha_fin = '$fecha_fin', fecha_inicio = '$fecha_inicio', id_etiquetas = '$id_etiqueta', id_estado = '$id_estado' WHERE id='".$idEvento."'";
} else {
    // Si no se selecciona una nueva imagen
    $actualizar_evento = "UPDATE eventoscalendar SET evento = '$evento', descripcion = '$descripcion', color_evento = '$color', fecha_fin = '$fecha_fin', fecha_inicio = '$fecha_inicio', id_etiquetas = '$id_etiqueta', id_estado = '$id_estado' WHERE id='".$idEvento."'";
}
// Si el estado es "Pendiente", establece la fecha de finalización como NULL
if ($id_estado == 'pendiente') {
    $fecha_fin = NULL;
}
// echo hola;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: calendario.php?ea=1");
?>
