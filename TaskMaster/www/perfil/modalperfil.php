
<?php
                include('../conexion/config.php');
                $usuario = $_SESSION['nombre'];
                $sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
                $res = mysqli_query($con, $sql);
                $fila = mysqli_fetch_assoc($res);
                $id_usuario = $fila['id_usuario'];
                $SqlEventos2   = "SELECT * FROM usuario us 
                inner join ciudad ci 
                on ci.id_ciudad= us.ciudad  WHERE us.id_usuario= $id_usuario";
                $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                $registro2 = mysqli_fetch_assoc($resulEventos2);
?>
<div class="modal fade" id="perfil_<?php echo $registro2['id_usuario']; ?>" tabindex="-1" aria-labelledby="perfil_<?php echo $registro2['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perfil_<?php echo $registro2['id_usuario']; ?>">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="perfil" id="perfil_<?php echo $registro['id']; ?>"  enctype="multipart/form-data" action="
        " class="form-horizontal" method="POST"></form>
      
<input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro2['id_usuario']; ?>">      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" value="<?php echo $registro2['nombre'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" value="<?php echo $registro2['apellido'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
          <select name="id_estado" class="form-control"> 
              <option selected disabled>Seleccione la categoria</option>
              <?php
              include("config.php");
              mysqli_select_db($con, "practicas");
              $consultarUsuario = "SELECT * FROM ciudad";

              $sqlUsuario = mysqli_query($con, $consultarUsuario);
              echo "<option selected value='" . $registro2['id_ciudad'] . "'>" . $registro2['nombre_ciudad'] . "</option>";
            
              // Verifica si hay resultados antes de recorrerlos
              if ($sqlUsuario) {
                  while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                      echo "<option value='" . $resultadoUsuario['id_ciudad'] . "'>" . $resultadoUsuario['nombre_ciudad'] . "</option>";
                  }
              } else {
                  echo "Error en la consulta: " . mysqli_error($conn);
              }
              ?>
          </select>			
        </div>
		</div>

    <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro2['nombre_ciudad']; ?>">      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" value="<?php echo $registro2['correo_electronico'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>