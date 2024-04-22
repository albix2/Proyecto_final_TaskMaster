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
  <!-- css -->
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/estilo.css" >
    <title>Document</title>
</head>
<body>
<header>
    <h1 class="fw-bold fs-3">gestor de tareas</h1>
    
</header>
<?php
include('../conexion/config.php');

$SqlEventos   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario WHERE ue.id_usuario = $id_usuario";
$resulEventos = mysqli_query($conn, $SqlEventos); // Utiliza la misma variable de conexión
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
                <a href="../kanban/kanban.html"><i class="bi bi-kanban"></i>Kamban </a>
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
    <section class="principal-chatper">
    <table>
    <thead>
        <tr>
            <th scope="col">Tarea</th>
            <th scope="col">personas</th>
            <th scope="col">chat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($registro = mysqli_fetch_assoc($resulEventos)) {
        ?>
            <tr class="align-middle">
                <td><?php echo $registro['evento']; ?></td>
                <td>
                    <?php
                    $compartir = $registro['id'];
                    $SqlEventos2   = "SELECT * FROM eventoscalendar ev INNER JOIN usuario_evento ue ON ue.id_evento = ev.id INNER JOIN usuario us ON ue.id_usuario=us.id_usuario WHERE ev.id = $compartir ";
                    $usuario = $_SESSION['nombre'];
                    $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                    ?>
                    <?php
                    while($registro2 = mysqli_fetch_assoc($resulEventos2)) {
                        $nombre_compartir = $registro2['nombre'];
                    //    echo $usuario;
                        if($nombre_compartir == $usuario) {

                          ?>
                          <p>yo </p>
                          <?php    // No mostrar nada
                        } else {
                    ?>
                        <p><?php echo $registro2['nombre']; ?></p>
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
               
                    <a href="per_chat.php?id=<?php echo $registro['id']; ?>">
                        <i class="bi bi-chat-dots" style="font-size: 2rem; color:green;"></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

       
        
 </section> 
</main>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 <!-- <p>hofgla</p>    -->
</body>
</html>