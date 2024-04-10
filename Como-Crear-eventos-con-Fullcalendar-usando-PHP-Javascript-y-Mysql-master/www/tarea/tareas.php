<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/estilo.css" >
    <title>Document</title>
</head>
<body>
<header>
    <h1 class="fw-bold fs-5">Gestor de Tareas</h1>
</header> 
<?php
include('../conexion/config.php');

$SqlEventos   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario WHERE ue.id_usuario = $id_usuario";
$resulEventos = mysqli_query($conn, $SqlEventos); // Utiliza la misma variable de conexión
?>

<main>
    <section class="enlaces">
        <ul>
            <li><a href="#"><i class="bi bi-calendar3"></i> Calendario</a></li>
            <li><a href="#"><i class="bi bi-calendar2-event"></i> Tareas</a></li>
            <li><a href="#"><i class="bi bi-people-fill"></i> Grupo de Trabajo</a></li>
            <li><a href="#"><i class="bi bi-kanban"></i> Kamban</a></li>
            <li><a href="#"><i class="bi bi-chat-dots"></i> Chat</a></li>
            <li><a href="#"><i class="bi bi-share"></i> Compartir</a></li>
            <li><a href="#"><i class="bi bi-person-fill-gear"></i> Perfil</a></li>
        </ul>
    </section> 
    <section class="principal-tarea">
        <table>
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Archivos</th>
                    <th scope="col">compartir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($registro = mysqli_fetch_assoc($resulEventos)) {
                ?>
                    <tr class="align-middle">
                        <td><?php echo $registro['evento']; ?></td>
                        <td><?php echo $registro['descripcion']; ?></td>
                        <td><?php echo $registro['fecha_inicio']; ?></td>
                        <td><?php echo $registro['fecha_fin']; ?></td>
                        <td><?php echo $registro['id_estado']; ?></td>
                        <td><?php echo $registro['id_etiquetas']; ?></td>
                        
                        <td>
                          <a href="<?php echo $registro['archivos']; ?>"><?php echo $registro['archivos']; ?></a>
                            
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section> 
</main>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>