<?php
include "login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../login/index.php");
    exit; // Detener la ejecución del script después de la redirección
}

$usuario = $_SESSION['nombre'];


$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($res);
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
<header class="titulo"> 
    <h1 class="fw-bold fs-5">Gestor de Tareas</h1>
    <a href="../cerrarSesion.php" role="button">
                    <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; color:black;"></i>
    </a>
</header> 
<?php
include('login/config.php');
$SqlEventos   = "SELECT * FROM eventoscalendar ev 
inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario 
inner join estado es on es.id_estado=ev.id_estado 
inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
inner join archivo_evento ae on ae.id_evento = ev.id
inner join archivos ar on ae.id_archivo= ar.id_archivo
where us.id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual
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
                <a href="../perfil/perfil.php
                "><i class="bi bi-person-fill-gear"></i>pefil</a>
            </li>
        </ul>
    </section>