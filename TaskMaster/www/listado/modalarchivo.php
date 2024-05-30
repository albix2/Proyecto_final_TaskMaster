
<div class="modal fade" id="archivo_<?php echo $registro['id']; ?>" tabindex="-1" aria-labelledby="archivo_<?php echo $registro['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Descargar evento:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
      <?php 
        $id_evento = $registro['id'];
        // echo $id_evento;
        
        // Consulta SQL para obtener detalles del evento y el archivo asociado
        $SqlEventos2 = "SELECT * FROM eventoscalendar ev 
                        INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
                        INNER JOIN usuario us ON ue.id_usuario = us.id_usuario 
                        INNER JOIN estado es ON es.id_estado = ev.id_estado 
                        INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas 
                        INNER JOIN archivos ar ON ar.id_evento = ev.id
                        WHERE us.id_usuario = $id_usuario AND ar.id_evento = $id_evento"; // Seleccionar solo eventos del usuario actual
        
        $resulEventos2 = mysqli_query($con, $SqlEventos2);

        // Verificar si la consulta se ejecutó correctamente
        
                // Iterar sobre los resultados y mostrar los datos
                while ($registroEvento = mysqli_fetch_assoc($resulEventos2)) {
                    $filename = basename($registroEvento['nombre_archivo']); // Obtener solo el nombre del archivo
                    echo '<div><a href="' . $registroEvento['nombre_archivo'] . '">' . $filename . '</a>';
                    ?>
              <a href="eliminar_archivo.php?id=<?php echo $registroEvento['id_archivo']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a></p>

</div>
                <?php     
                }
          
        
        ?>
        <br>
        
      </div>
    </div>
  </div>
</div>
