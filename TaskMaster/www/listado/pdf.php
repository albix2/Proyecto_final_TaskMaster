<?php
require_once('../conexion/config.php');
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$id = $_REQUEST['id'];
$id_usuario = $_SESSION['id_usuario'];


mysqli_select_db($con, "practicas");

$sql = "SELECT ev.evento, ev.descripcion, ev.fecha_inicio, ev.fecha_fin, es.nombre_estado, et.nombre_etiqueta
FROM eventoscalendar ev 
INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
INNER JOIN usuario us ON ue.id_usuario = us.id_usuario
INNER JOIN estado es ON es.id_estado = ev.id_estado
INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
WHERE us.id_usuario = $id_usuario";

// Verificar si se proporcionó algún criterio de búsqueda
if (!empty($_GET['evento'])) {
    $evento = mysqli_real_escape_string($con, $_GET['evento']);
    $sql .= " AND ev.evento LIKE '%$evento%'";
}

if (!empty($_GET['descripcion'])) {
    $descripcion = mysqli_real_escape_string($con, $_GET['descripcion']);
    $sql .= " AND ev.descripcion LIKE '%$descripcion%'";
}

if (!empty($_GET['fecha_inicio'])) {
    $fecha_inicio = mysqli_real_escape_string($con, $_GET['fecha_inicio']);
    $sql .= " AND ev.fecha_inicio >= '$fecha_inicio'";
}

if (!empty($_GET['fecha_fin'])) {
    $fecha_fin = mysqli_real_escape_string($con, $_GET['fecha_fin']);
    $sql .= " AND ev.fecha_fin <= '$fecha_fin'";
}

if (!empty($_GET['id_estado'])) {
    $id_estado = mysqli_real_escape_string($con, $_GET['id_estado']);
    $sql .= " AND ev.id_estado = '$id_estado'";
}

if (!empty($_GET['id_etiqueta'])) {
    $id_etiqueta = mysqli_real_escape_string($con, $_GET['id_etiqueta']);
    $sql .= " AND ev.id_etiquetas = '$id_etiqueta'";
}

$resultset = mysqli_query($con, $sql);

if (!$resultset) {
    die("Error en la consulta: " . mysqli_error($con));
}
 


require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',7);
while ($field_info = mysqli_fetch_field($resultset)) {
$pdf->Cell(38,12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
$pdf->SetFont('Arial','',7);
$pdf->Ln();
foreach($rows as $column) {
$pdf->Cell(38,7,$column,1);
}
}
$pdf->Output();
?>
?>
