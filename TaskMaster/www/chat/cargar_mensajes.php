<?php
include "../login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../login/index.php");
    exit; // Detener la ejecución del script después de la redirección
}
include('../conexion/config.php');
$id_evento = $_GET['id'];
$SqlEventos3 = "SELECT * FROM eventoscalendar e LEFT JOIN chat c ON e.id = c.id_evento INNER JOIN usuario u ON c.id_usuario = u.id_usuario WHERE c.id_evento = $id_evento ORDER BY fecha_envio DESC";
$resulEventos3 = mysqli_query($con, $SqlEventos3);
$usuario = $_SESSION['nombre'];


$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($res);
$id_usuario = $fila['id_usuario'];
while($registro4 = mysqli_fetch_assoc($resulEventos3)) {
    $nombre_compartir = $registro4['id_usuario'];
    if($nombre_compartir == $id_usuario) {
?>
<article class="mensaje me">
    <p><?php echo $registro4['mensaje']; ?></p>
</article>
<?php
    } else {
?> 
<article class="mensaje">
    <p><?php echo $registro4['mensaje']; ?></p>
</article>
<?php
    }
}
?>
