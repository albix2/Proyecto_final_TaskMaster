<?php include('../header.php'); ?>
<section class="principal-perfil">
<?php
                include('../conexion/config.php');
                $SqlEventos2   = "SELECT * FROM usuario us 
                inner join ciudad ci 
                on ci.id_ciudad= us.ciudad  WHERE us.id_usuario= id_usuario";
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
<!-- <p><?php echo$registro2[''] ; ?></p> -->
<?php
// echo $id_usuario ;

?>
</section>