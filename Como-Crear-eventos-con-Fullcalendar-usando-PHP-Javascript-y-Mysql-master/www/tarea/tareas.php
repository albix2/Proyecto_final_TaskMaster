<?php
include "../header.php";

?>

    <section class="principal-tarea">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  nuevo evento
</button>

        <table  class="table">
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
                    <th scope="col">borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($registro = mysqli_fetch_assoc($resulEventos)) {
                ?>
                    <tr class="align-middle">
                        <td scope="row" data-label="evento"><?php echo $registro['evento']; ?></td>
                        <td data-label="Descripción"><?php echo $registro['descripcion']; ?></td>
                        <td data-label="Fecha de inicio"><?php echo $registro['fecha_inicio']; ?></td>
                        <td data-label="Fecha final"><?php echo $registro['fecha_fin']; ?></td>
                        <td data-label="Estado"><?php echo $registro['nombre_estado']; ?></td>
                        <td data-label="Etiquetas"><?php echo $registro['id_etiquetas']; ?></td>
                        
                        <td data-label="Archivo">
                            <?php 
                            $filename = basename($registro['archivos']); // Obtener solo el nombre del archivo
                            ?>
                            <a href="<?php echo $registro['archivos']; ?>"><?php echo $filename; ?></a>
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
</td>

                        <td data-label="Borrar"> <a href="deleteEvento.php?id=<?php echo $registro['id']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a></td>  

                    </tr>
                    <?php  

  include('modalUpdateEvento.php');
  include('modalcompartir.php');
  

?>
 
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <?php  
include('modalNuevoEvento.php');

  

?>
    </section> 
</main>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
