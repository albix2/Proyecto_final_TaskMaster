<?php

include "../header.php";
$registro = mysqli_fetch_assoc($resulEventos);

?>

<section class="principal-listado">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  listodo evento
</button>
<a type="button" data-bs-toggle="modal" data-bs-target="#pdf_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-download" style="font-size: 2rem; color:blue;"></i>
    </a>
<?php  
include('../tarea/modalpdf.php');
include('modalNuevoEvento.php');

$evento = $_POST['evento'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$id_etiqueta = $_POST['id_etiqueta'];
$id_estado = $_POST['id_estado'];
$color = $_POST['color'];  
  
  

  

?>
        <table  class="tabla">
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Archivos</th>
                    <th scope="col">compartido por:</th>
                    <th scope="col">compartir</th>
                    
                    <th scope="col">actualizar</th>
                    <th scope="col">pdf</th>
                    <th scope="col">borrar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include('../login/config.php');
                $sql = "SELECT ev.*, es.nombre_estado, et.nombre_etiqueta, us.nombre 
        FROM eventoscalendar ev 
        INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
        INNER JOIN usuario us ON ue.id_usuario = us.id_usuario
        INNER JOIN estado es ON es.id_estado = ev.id_estado
        INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
        WHERE  us.id_usuario = $id_usuario"; // Inicialmente seleccionar todas las tareas

// Verificar si se proporcionó el nombre del evento en el formulario
if (!empty($_POST['evento'])) {
    $evento = mysqli_real_escape_string($conexion, $_POST['evento']);
    $sql .= " AND ev.evento LIKE '%$evento%'"; // Agregar condición de búsqueda por evento
}

// Verificar si se proporcionó la descripción en el formulario
if (!empty($_POST['descripcion'])) {
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $sql .= " AND ev.descripcion LIKE '%$descripcion%'"; // Agregar condición de búsqueda por descripción
}

// Verificar si se proporcionó la fecha de inicio en el formulario
if (!empty($_POST['fecha_inicio'])) {
    $fecha_inicio = mysqli_real_escape_string($conexion, $_POST['fecha_inicio']);
    $sql .= " AND ev.fecha_inicio >= '$fecha_inicio'"; // Agregar condición de búsqueda por fecha de inicio
}

// Verificar si se proporcionó la fecha final en el formulario
if (!empty($_POST['fecha_fin'])) {
    $fecha_fin = mysqli_real_escape_string($conexion, $_POST['fecha_fin']);
    $sql .= " AND ev.fecha_fin <= '$fecha_fin'"; // Agregar condición de búsqueda por fecha final
}

// Verificar si se proporcionó el estado en el formulario
if (!empty($_POST['id_estado'])) {
    $id_estado = mysqli_real_escape_string($conexion, $_POST['id_estado']);
    $sql .= " AND ev.id_estado = '$id_estado'"; // Agregar condición de búsqueda por estado
}

// Verificar si se proporcionó la etiqueta en el formulario
if (!empty($_POST['id_etiqueta'])) {
    $id_etiqueta = mysqli_real_escape_string($conexion, $_POST['id_etiqueta']);
    $sql .= " AND ev.id_etiquetas = '$id_etiqueta'"; // Agregar condición de búsqueda por etiqueta
}

// Ejecutar la consulta SQL
$result = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
     

?>
               
                <?php
                
                while($registro = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="align-middle">
                        <td scope="row" data-label="evento"><?php echo $registro['evento']; ?></td>
                        <td data-label="Descripción"><?php echo $registro['descripcion']; ?></td>
                        <td data-label="Fecha de inicio"><?php echo $registro['fecha_inicio']; ?></td>
                        <td data-label="Fecha final"><?php echo $registro['fecha_fin']; ?></td>
                        <td data-label="Estado"><?php echo $registro['nombre_estado']; ?></td>
                        <td data-label="Etiquetas"><?php echo $registro['nombre_etiqueta']; ?></td>
                        
                        </td>
                        <td data-label="Archivos">
    <a type="button" data-bs-toggle="modal" data-bs-target="#archivo_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-file-earmark" style="font-size: 2rem; color:black;"></i>
    </a>
</td>

                        <td data-label="Compartido por:">
                        <?php
                        $compartir = $registro['id'];
                        $SqlEventos2   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
                        inner join usuario us on ue.id_usuario=us.id_usuario WHERE ev.id = $compartir ";
                        $usuario = $_SESSION['nombre'];
                        $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                while($registro2 = mysqli_fetch_assoc($resulEventos2)) {
                    $nombre_compartir =$registro2['nombre'];
                    // echo $usuario;
                    if($nombre_compartir == $usuario) {
                        ?>   
                   <P>Yo</P>
                   
                    <?php
                    } else{
                        
                ?>
               
                <p><?php echo $registro2['nombre'];?></p>
                <?php
                }
                }
                ?>
                        </td>
                        <td data-label="Compartir">
    <a type="button" data-bs-toggle="modal" data-bs-target="#compartir_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-people-fill" style="font-size: 2rem; color:blue;"></i>
    </a>
</td>


<td data-label="Actualizar">
    <a type="button" data-bs-toggle="modal" data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
        <i class="bi-pencil px-1" style="font-size: 2rem; color:green;"></i>
        
    </a>
    <td data-label="descarga">
    <a type="button" data-bs-toggle="modal" data-bs-target="#pdf_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-download" style="font-size: 2rem; color:blue;"></i>
    </a>
</td>
                        <td data-label="Borrar"> <a href="deleteEvento.php?id=<?php echo $registro['id']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a></td>  

                    </tr>
                    <?php  

  include('../tarea/modalUpdateEvento.php');
  include('../tarea/modalcompartir.php');
  include('../tarea/modalpdf.php');
  include('../tarea/modalarchivo.php');

?>
 
                <?php
                }
                ?>
            </tbody>
        </table>
        
        
    </section> 
</main>
<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>


</section>