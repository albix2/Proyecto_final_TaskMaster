<?php include('../header.php'); ?>
<section class="principal-perfil">
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
<?php 
echo "<img width='300hm' height='300hm' src='../{$registro2['imagen']}' alt='Imagen de producto'>"; 
?>
<p><?php echo$registro2['nombre'] ; ?></p>
<p><?php echo$registro2['apellido'] ; ?></p>
<p><?php echo$registro2['nombre_ciudad'] ; ?></p>
<p><?php echo$registro2['correo_electronico'] ; ?></p>

    <button type="button"data-bs-toggle="modal" data-bs-target="#perfil_<?php echo $registro2['id_usuario']; ?>" data-id="<?php echo $registro2id_usuario['id_usuario']; ?>">
  Launch demo modal
</button>
<?php
// echo $id_usuario ;
include('modalperfil.php');
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</section>