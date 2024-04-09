<?php
include "login/conexion.php";
mysqli_select_db($conexion, "productosbd");
session_start();
$usuario = $_SESSION['nombre'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
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
              
         <!-- sd -->
              
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
                        <span><a href="/calendario/calendario.php"><i class="bi bi-calendar3"></i></a></span>
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
                <h2>Resumen de tiempo trabajado</h2>
                <p>
                    <span class="valor">0</span> horas
                    <span class="valor">0</span> minutos
                    <span class="valor">1</span> segundo
                </p>
            </div>
            
        </section>
    </main>
   

    <footer class="container-fluid">
        <p>3Dreams - Impresión 3D y más</p>
        <p>Vendemos materiales, piezas y diseños</p>
        <p>Tu dirección | Tu número de teléfono | Tu correo electrónico</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>