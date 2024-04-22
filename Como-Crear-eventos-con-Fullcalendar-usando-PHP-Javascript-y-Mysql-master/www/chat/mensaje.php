<?php
include "../login/conexion.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión

if (!isset($_SESSION['nombre'])) { // Verifica si el usuario está autenticado
    header("Location: ../index.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener datos del formulario
$evento = $_POST["idEvento"];
$usuario = $_POST["idusuario"];
$mensaje = $_POST["mensaje"];

// Verificar si el mensaje no está vacío
if (!empty(trim($mensaje))) {
    // Consulta SQL para insertar el mensaje en la base de datos
    $insertardos = "INSERT INTO chat (id_evento, id_usuario, mensaje) VALUES ('$evento', '$usuario', '$mensaje')";

    // Ejecutar la consulta
    $resultadoNuevoEvento = mysqli_query($conn, $insertardos);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultadoNuevoEvento) {
        // Redirigir a la página de chat
        header("Location: per_chat.php?id=$evento");
        exit; // Finalizar el script después de la redirección
    } else {
        // Mostrar mensaje de error si la inserción falla
        echo "Error al insertar el evento: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje de error si el mensaje está vacío
    header("Location: per_chat.php?id=$evento");
}
?>
