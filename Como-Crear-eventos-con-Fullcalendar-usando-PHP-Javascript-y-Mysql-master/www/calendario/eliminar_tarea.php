<?php
require_once('config.php');
$id    		= $_REQUEST['id']; 
include "../login/conexion.php";
mysqli_select_db($conn, "practicas");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}
$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($conn, $sql);
$fila = mysqli_fetch_assoc($res);
$id_usuario = $fila['id_usuario'];
$sqlDeleteEvento = ("DELETE FROM eventoscalendar WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);
$sqlDeleteEvento2 = "DELETE FROM usuario_evento WHERE id_evento = '" . $id . "' AND id_usuario = '" . $id_usuario . "'";
echo $id;
echo $id_usuario;
$resultProd2 = mysqli_query($con, $sqlDeleteEvento2);
header("Location: mistareas.php");
?>