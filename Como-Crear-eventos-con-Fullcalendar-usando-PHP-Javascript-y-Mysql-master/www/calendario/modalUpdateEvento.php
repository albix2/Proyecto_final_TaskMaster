

<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar mi Eventox</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form name="formEventoUpdate" id="formEventoUpdate"  enctype="multipart/form-data" action="actualizar_evento2.php" class="form-horizontal" method="POST">
      
      <input type="hidden" class="form-control" name="idEvento" id="idEvento">
      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" required/>
			</div>
		</div>

    <div class="form-group">
			<label for="descripcion" class="col-sm-12 control-label">Nombre del descripcion</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Nombre del descripcion" required/>
			</div>
		</div>

    <div class="form-group">
      <label for="" class="form-label"><b>Nombre de la etiqueta</b></label>
      <div class="col-sm-10">
      <select name="id_etiqueta" class="form-control">
          <option selected disabled>Seleccione la categoria</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM etiquetas";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);

          // Verifica si hay resultados antes de recorrerlos
          if ($sqlUsuario) {
              while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                  echo "<option value='" . $resultadoUsuario['id_etiqueta'] . "'>" . $resultadoUsuario['nombre_etiqueta'] . "</option>";
              }
          } else {
              echo "Error en la consulta: " . mysqli_error($conn);
          }
          ?>
      </select>
    </div>
    </div>

    <div class="form-group">
      <label for="" class="form-label"><b>Estado</b></label>
      <div class="col-sm-10">
      <select name="id_estado" class="form-control">
          <option selected disabled>Seleccione la categoria</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM estado";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);

          // Verifica si hay resultados antes de recorrerlos
          if ($sqlUsuario) {
              while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                  echo "<option value='" . $resultadoUsuario['id_estado'] . "'>" . $resultadoUsuario['nombre_estado'] . "</option>";
              }
          } else {
              echo "Error en la consulta: " . mysqli_error($conn);
          }
          ?>
      </select>
    </div>
    </div>

    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio">
      </div>
    </div>

    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final">
      </div>
    </div>
  

  <div class="form-group">
    <label for="color" class="form-label"><b>color </b></label>
    <div class="col-sm-10">
    <input type="color"
      class="form-control" name="color" id="color"  required aria-describedby="helpId" placeholder="color">
    <small id="helpId" class="form-text text-muted">color</small>
  </div>
  </div>
 

        <!-- Campo oculto para almacenar la ruta del archivo actual -->
        <input type="hidden" name="archivo_actual" id="archivo_actual">

        <!-- Muestra el archivo actual -->
        <div class="form-group">
          <label for="archivo_actual">Archivo Actual:</label>
          <a id="archivo_actual_link" href="#" target="_blank"></a>
        </div>
<!-- Agrega un nuevo campo de entrada de tipo file para permitir al usuario seleccionar un nuevo archivo -->
<div class="form-group">
    <label for="fotografia">Nuevo Archivo:</label>
    <input type="file" class="form-control" name="fotografia" id="fotografia" required accept="image/*, .pdf, .doc, .docx, .odt">
</div>

	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
    </div>
  </div>
</div>