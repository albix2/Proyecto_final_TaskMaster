<?php
require_once('../conexion/config.php');
$id = $_REQUEST['id'];
mysqli_select_db($con, "practicas");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($con, $sql);
$fila = mysqli_fetch_assoc($res);
$id_usuario = $fila['id_usuario'];



$consultar = "SELECT ev.evento, ev.archivos, ev.descripcion, ev.fecha_fin, ev.fecha_inicio, es.nombre_estado FROM eventoscalendar ev 
        INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
        INNER JOIN usuario us ON ue.id_usuario=us.id_usuario 
        inner join estado es on es.id_estado = ev.id_estado
        WHERE ue.id_usuario = $id_usuario and ev.id = $id";

$resultset = mysqli_query($con, $consultar);
$columnWidths = array(30, 55, 25, 30, 30, 25); 
$columnWidth = array(30, 55, 25, 30, 30, 25); 

$sql2 = "SELECT evento, id FROM eventoscalendar where id = $id ";
$res2 = mysqli_query($con, $sql2);
$fila2 = mysqli_fetch_assoc($res2);
$nombre_pdf = $fila2['evento']; 
$id_pdf = $fila2['id']; 
require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',7);
while ($field_info = mysqli_fetch_field($resultset)) {
    $pdf->Cell(array_shift($columnWidths),12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
    $pdf->SetFont('Arial','',7);
    $pdf->Ln();
    foreach($rows as $column) {
        $pdf->Cell(array_shift($columnWidth),7,$column,1);
    }
}

// Generar el PDF y enviarlo por WhatsApp
$pdf->Output('F', '../pdf/'. $nombre_pdf.$id_pdf  . '.pdf');// Guardar el PDF temporalmente en el servidor
$pdf->Output('I'); // Enviar el PDF al navegador

// Luego puedes eliminar el PDF temporal si no lo necesitas más
unlink('temp_pdf.pdf');
?>
