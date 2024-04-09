<?php
include "login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}
$sql = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
$res = mysqli_query($conn,$sql);
$fila = mysqli_fetch_assoc($res);
    // Obtiene el id del usuario de la fila obtenida
    $id_usuario = $fila['id_usuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/calendario.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<header class="container-fluid">
       
<nav class="navegador">
            <img class="icono" src="../imagenes/tasksmart.png" alt="Logo de 3Dreams">
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php?pagina=1">productos </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">piezas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">diseños</a>
                </li>
                <li class="dropdown open">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bienvenido<?php echo ": ".$_SESSION['nombre'] ?>
                </a>                
            </li>  -->
                <a href="cerrarSesion.php"  role="button">
                    <i class="bi bi-box-arrow-right"></i>
                </a>     
              
           
              
              <!-- <form class="form-inline" action="busqueda.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
               -->
          
          </nav>
</header>
      
       
  <main class="principal">
  <section id="menu">
            <ul>
                <li>
                    <a href="#">
                        
                        <span><a href="creartarea.php"><i class="bi bi-plus"></i></a></span>
                    </a>
                </li>
                <li>
                    <a href="mistareas.php">
                       
                        <span><i class="bi bi-folder"></i></span>
                    </a>
                <li>
                    <a href="#">
                        <i class='bx bx-list-ul'></i>
                        <span><a href="calendario.php"><i class="bi bi-calendar3"></i></a></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                       
                        <span><i class="bi bi-tag"></i></span>
                    </a>
                </li>
                <li>
                    <a href="perfil.php">
                       
                        <span><i class="bi bi-gear"></i></span>
                    </a>
                </li>
                
            </ul>
        </section>
       <section id="contenido">
       <div id="resumen">
      
       <?php 
include("config.php");
$resultados = mysqli_query($con,"SELECT * FROM eventoscalendar ev 
                                    INNER JOIN etiquetas et ON et.id_etiqueta=ev.id_etiquetas 
                                    INNER JOIN estado es ON es.id_estado=ev.id_estado where id_usuario = $id_usuario ");
$total_registros = mysqli_num_rows($resultados);

if ($total_registros) {
    while ($productos = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // Verificar si la fecha y hora actual es posterior a la fecha de finalización y el estado es "En proceso"
        $fecha_actual = date("Y-m-d H:i:s");
        // echo $fecha_actual;
        if ($productos['nombre_estado'] == 'En proceso' && $productos['fecha_fin'] > $fecha_actual) {
            // Cambiar el estado a "Completado"
            $id_evento = $productos['id'];
            $resultado_estado = mysqli_query($con, "SELECT id_estado FROM estado WHERE nombre_estado ='completado'");
            $row = mysqli_fetch_assoc($resultado_estado);
            $id_estado = $row['id_estado'];
            $estado = "UPDATE eventoscalendar SET id_estado ='$id_estado' WHERE id = '$id_evento'";
            // echo $estado;
            mysqli_query($con, $estado);
            // Actualizar la variable $productos para reflejar el cambio
            $productos['id_estado'] = 'completado';
        }
?>
<div class="productos">
    <?php if (strpos($productos['archivos'], '.jpg') !== false || strpos($productos['archivos'], '.png') !== false || strpos($productos['archivos'], '.gif') !== false) { ?>
        <img src="<?php echo $productos['archivos']; ?>" alt="Imagen de usuario">
    <?php } else { ?>
        <a href="<?php echo $productos['archivos']; ?>"><?php echo $productos['archivos']; ?></a>
    <?php } ?>
    <p><strong>Nombre:</strong> <?php echo $productos['evento']; ?></p>
    <p><strong>Descripción:</strong> <?php echo $productos['descripcion']; ?></p>
    <p><strong>Estado:</strong> <?php echo $productos['nombre_estado']; ?></p>
    <p><strong>Fecha de inicio:</strong> <?php echo $productos['fecha_inicio']; ?></p>
    <?php if ($productos['id_estado'] == 'pendiente' && $productos['fecha_fin'] == NULL) { ?>
        <p><strong>Fecha fin:</strong> Sin fecha de finalización</p>
    <?php } else { ?>
        <p><strong>Fecha fin:</strong> <?php echo $productos['fecha_fin']; ?></p>
    <?php } ?>
    <p><strong>Etiqueta:</strong> <?php echo $productos['nombre_etiqueta']; ?></p>
    <a href="actualizar_evento.php?id=<?php echo $productos['id']; ?>" class="btn btn-primary">Actualizar</a>
    <a href="eliminar_tarea.php?id=<?php echo $productos['id']; ?>" class="btn btn-primary">borrar</a>
</div>
<?php
    }
} else {
    echo "<font color='darkgray'>(sin resultados)</font>";
}
mysqli_free_result($resultados);
?>
        </div>
    </section>
    
                  
                  


<!-- <div class="enlace">
        <?php
        if ($total_registros) {
            /**
             * Aca activamos o desactivamos la opción "< Anterior", si estamos en la pagina 1 nos dará como resultado 0 por ende NO
             * activaremos el primer if y pasaremos al else en donde se desactiva la opción anterior. Pero si el resultado es mayor
             * a 0 se activara el href del link para poder retroceder.
             */
            if (($pagina - 1) > 0) {
                echo "<a href='index.php?pagina=".($pagina-1)."'>< Anterior</a>";
            } else {
                echo "<a href='#'>< Anterior</a>";
            }
 
            // Generamos el ciclo para mostrar la cantidad de paginas que tenemos.
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($pagina == $i) {
                    echo "<a href='#'>". $pagina ."</a>";
                } else {
                    echo "<a href='index.php?pagina=$i'>$i</a> ";
                }
            }
 
            /**
             * Igual que la opcion primera de "< Anterior", pero aca para la opcion "Siguiente >", si estamos en la ultima pagina no podremos
             * utilizar esta opcion.
             */
            if (($pagina + 1)<=$total_paginas) {
                echo "<a href='index.php?pagina=".($pagina+1)."'>Siguiente ></a>";
            } else {
                echo "<a href='#'>Siguiente ></a>";
            }
        }
        ?>
    </div> -->
                     
        </div>             
       </section>
    </main>
            

                 

           



</body>
</html>