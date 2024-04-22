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
$id_evento=$_GET['id'];
?>
<main>
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
    <section class="principal-chat">
        <article class="perfil">
            <?php
                include('../conexion/config.php');

                $SqlEventos2   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
                inner join usuario us on ue.id_usuario=us.id_usuario WHERE ev.id = $id_evento";
                $resulEventos2 = mysqli_query($conn, $SqlEventos2); // Utiliza la misma variable de conexión
                $registro2 = mysqli_fetch_assoc($resulEventos2);
            ?>
            <h3><?php echo $registro2['evento']; ?></h3>
        </article>
       
        <?php
        
        
         $SqlEventos3   = "SELECT * FROM eventoscalendar e left JOIN chat c ON e.id = c.id_evento INNER JOIN usuario u ON c.id_usuario = u.id_usuario WHERE c.id_evento = $id_evento order by  fecha_envio desc ";
         $usuario = $_SESSION['nombre'];
         $sql5 = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
            $res5= mysqli_query($conn, $sql5);
        $fila5 = mysqli_fetch_assoc($res5);
        // $id_usuario = $fila5['id_usuario'];
         $resulEventos3 = mysqli_query($conn, $SqlEventos3);
         $fila2= mysqli_fetch_assoc($resulEventos3);
        //  echo $SqlEventos3;
        while($registro4 = mysqli_fetch_assoc($resulEventos3)) {
            $sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
            $res = mysqli_query($conn, $sql);
        $fila = mysqli_fetch_assoc($res);
        $id_usuario = $fila['id_usuario'];
        $nombre_compartir =$registro4['id_usuario'];
        // echo $id_usuario;
        if($nombre_compartir == $id_usuario) {
            ?> 
    
       
        
             <article class="mensaje me">
                    <p><?php echo $registro4['mensaje']; ?></p>
                    
                    </article>
                
                  
                    <?php
                    } else{
                        
                        
                ?> 
                <article class="mensaje ">
                    <p><?php echo $registro4['mensaje']; ?></p>
                    
                    </article>
                <?php
                    }
                }
                ?>
                   
             <form  name="formchat" id="formchat" class="formchat"  enctype="multipart/form-data" action="mensaje.php" class="form-horizontal" method="POST">
             <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo  $id_evento; ?>">      
             <input type="hidden" class="form-control" name="idusuario" id="idusuario" value="<?php echo $fila5['id_usuario']; ?>">      

             <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea> 
             <button type="submit" class="btn btn-success"><i class="bi bi-send"></i></button>
                
             </form> 
       
        
       
        
 </section> 
</main>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 <!-- <p>hofgla</p>    -->
</body>