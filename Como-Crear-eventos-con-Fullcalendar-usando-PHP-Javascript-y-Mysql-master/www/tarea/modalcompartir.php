<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="compartir_<?php echo $registro['id']; ?>" tabindex="-1" aria-labelledby="compartir_<?php echo $registro['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form name="formEvento" id="compartir_<?php echo $registro['id']; ?>" enctype="multipart/form-data" action="compartir.php" class="form-horizontal" method="POST">
      <?php 


mysqli_Select_db($conexion, "practicas");
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
  $id = $registro['id'];
//   // Aquí puedes hacer lo que necesites con el ID
//   echo "ID recibido: " . $id;
// } else {
//   echo "Error: No se recibió ningún ID.";
// }
$seleccionar = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado=ev.id_estado inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas  WHERE ev.id ='$id'";
$registros = mysqli_Query($conexion, $seleccionar);

if ($registro = mysqli_fetch_assoc($registros)) {
?>
      <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro['id']; ?>">      

    <div class="form-group">
        <label for="evento" class="col-sm-12 control-label">correo Electronico</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Nombre del Evento" required/>
        </div>
      </div>
  
  
 
      
       <div class="modal-footer">
          <button type="submit" class="btn btn-success">compartir</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      
    </div>
  </div>
</div>
<?php
} else {
    echo "No se encontró el producto para actualizar.";
}

?>