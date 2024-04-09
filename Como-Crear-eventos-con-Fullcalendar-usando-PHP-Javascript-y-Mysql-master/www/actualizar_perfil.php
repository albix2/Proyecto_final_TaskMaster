<?php
include "login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}
mysqli_Select_db($conexion, "ptacticas");
$eventoactualizar = $_GET["id"];
$seleccionar = "SELECT * FROM usuario us inner join ciudad ci on us.ciudad= ci.id_ciudad";
$registros = mysqli_Query($conexion, $seleccionar);
$registro = mysqli_fetch_assoc($registros);
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
                
       <h3> Ingresar datos:</h3>
                        <form class="p-10  w-100" method="POST" action="actualizar_pefil2.php?idmodifica=<?php echo $eventoactualizar;?>" enctype="multipart/form-data">
                        <div class="row">
                         <div class="col-md-7 col-12">
                            <div class="mb-3">
                              <label for="" class="form-label"> <b>nombre</b></label>
                              <input type="text"
                                class="form-control" name="evento" id="evento" value="<?php echo $registro['nombre'];?>"  required aria-describedby="helpId" placeholder="evento">
                              <small id="helpId" class="form-text text-muted">evento</small>
                            </div>

                            
                            <div class="mb-3">
                              <label for="" class="form-label"><b>apellidos</b></label>
                              <input type="text"
                                class="form-control" name="descripcion" id="descripcion" value="<?php echo $registro['apellido'];?>" required aria-describedby="helpId" placeholder="descripcion">
                              <small id="helpId" class="form-text text-muted">descripcion</small>
                            </div>

                            <div class="mb-3">
                              <label for="">ciudad</label>
                           
                              <select  name="ciudad" class="form-control">
                                <option   selected disabled>Seleccione la ciudad</option>
                                <?php
                                include("conexion.php");
                                mysqli_select_db($conn, "practicas");
                                $consultar = "SELECT * FROM ciudad";
                                $sql = mysqli_query($conn, $consultar);
                                
                                          echo "<option selected value='" . $registro['id_ciudad'] . "'>" . $registro['nombre_ciudad'] . "</option>";
                                if ($sql) {
                                    while ($resultado = mysqli_fetch_assoc($sql)) {
                                        echo "<option value='" . $resultado['id_ciudad'] . "'>" . $resultado['nombre_ciudad'] . "</option>";
                                    }
                                } else {
                                    echo "Error en la consulta: " . mysqli_error($conn);
                                }
                                ?>
                            </select>
                            </div>

                            <div class="mb-3">
                                    <label for="" class="form-label">archivo Antigua</label>
                                   
                                    <img src="<?php echo $registro['imagen']; ?>" alt="Imagen de usuario">
                               
                                </div>

                          
                            <div class="mb-3">
                              <label for="" class="form-label">Imagen</label>
                              <input type="file"
                                class="form-control" name="fotografia" id="fotografia" required accept="image/*, .pdf, .doc, .docx, .odt">
                              <small id="helpId" class="form-text text-muted">fotografia</small>
                            </div>

                            <div class="">
                                <input type="submit" class="btn btn-primary" value="Enviar reseña">
                            </div>
                            </div>
                          </div>
                        </form>
                        </div>
                        </div>             
       </section>
    </main>
            

                 

           



</body>
</html>