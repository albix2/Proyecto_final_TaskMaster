<?php
include "login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}
$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($res);
// Obtiene el id del usuario de la fila obtenida
$id_usuario = $fila['id_usuario'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mi Calendario:: Ing. Urian Viera</title>
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/estilo.css" >
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/calendario.css">
</head>
<body class="body">
<header> 
    <h1 class="fw-bold fs-5">Gestor de Tareas</h1>
</header> 
<?php
include('login/config.php');
$SqlEventos   = "SELECT * FROM eventoscalendar ev 
                INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
                INNER JOIN usuario us ON ue.id_usuario=us.id_usuario 
                inner join estado es on es.id_estado = ev.id_estado
                WHERE ue.id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual
$resulEventos = mysqli_query($conexion, $SqlEventos);
?>
<main class="principal">
    <section class="enlaces">
        <ul>
            <li>
                <a href="../calendario/calendario.php"><i class="bi bi-calendar3"></i>calendario</a>
            </li>
            <li>
                <a href="../tarea/tareas.php"><i class="bi bi-calendar2-event"></i>Tareas</a>
            </li>
            <li>        
                <a href=""><i class="bi bi-people-fill"></i>grupo de trabajo</a>
            </li>
            <li>
                <a href="../kanban/kanban.php"><i class="bi bi-kanban"></i>Kamban </a>
            </li>
            <li>
                <a href="../chat/chat.php"><i class="bi bi-chat-dots"></i>chat</a>
            </li>
            <li>
                <a href=""><i class="bi bi-share"></i>compartir</a>
            </li>
            <li>
                <a href=""><i class="bi bi-person-fill-gear"></i>pefil</a>
            </li>
        </ul>
    </section>