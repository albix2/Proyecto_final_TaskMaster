<?php
include "../login/conexion.php";
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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mi Calendario:: Ing. Urian Viera</title>
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/calendario.css">
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

<?php
include('config.php');

$SqlEventos   = "SELECT * FROM eventoscalendar WHERE id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual
$resulEventos = mysqli_query($con, $SqlEventos);
?>



<main class="principal">
<section id="menu">
            <ul>
                <li>
                    <a href="#">
                        
                        <span><a href="creartarea.php"><i class="bi bi-plus"></i></a></span>
                    </a>
                </li>
                <li>
                    <a href="../mistareas.php">
                       
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
    
<?php
include('config.php');

  $SqlEventos   = ("SELECT * FROM eventoscalendar");
  $resulEventos = mysqli_query($con, $SqlEventos);

?>
<div class="mt-5"></div>

<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs.php');
      ?>
    </div>
  </div>

<!-- <div class="row">
  <div class="col-md-12 mb-3">
  <h3 class="text-center" id="title">Como crear un Calendario de Eventos con PHP y MYSQL</h3>
  </div>
</div> -->
</div>



<div id="calendar"></div>


<?php  
include('modalNuevoEvento.php');
  include('modalUpdateEvento.php');
  

?>



<script src ="/js/jquery-3.0.0.min.js"> </script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/js/moment.min.js"></script>	
<script type="text/javascript" src="/js/fullcalendar.min.js"></script>
<script src='/locales/es.js'></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#calendar").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },

        locale: 'es',

        defaultView: "month",
        navLinks: true, 
        editable: true,
        eventLimit: true, 
        selectable: true,
        selectHelper: false,

        // Nuevo Evento
        select: function(start, end){
            $("#exampleModal").modal();
      $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY HH:mm:ss'));
       
      var valorFechaFin = end.format("DD-MM-YYYY HH:mm:ss");
var F_final = moment(valorFechaFin, "DD-MM-YYYY HH:mm:ss").format('DD-MM-YYYY HH:mm:ss');
      $('input[name=fecha_fin').val(F_final);  
      if (event) {
        $("input[name=evento]").val(event.evento);
        $("input[name=descripcion]").val(event.descripcion);
        $("select[name=id_estado]").val(event.id_estado);
        $("select[name=id_etiqueta]").val(event.id_etiqueta);
    }
        },
        
        events: [
            <?php
            while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
                {
                _id: '<?php echo $dataEvento['id']; ?>',
                title: '<?php echo $dataEvento['evento']; ?>',
                start: '<?php echo $dataEvento['fecha_inicio']; ?>',
                end:   '<?php echo $dataEvento['fecha_fin']; ?>',
                color: '<?php echo $dataEvento['color_evento']; ?>',
                id_usuario: '<?php echo $dataEvento['id_usuario']; ?>',
                fotografia: '<?php echo $dataEvento['archivos']; ?>',
                descripcion: '<?php echo $dataEvento['descripcion']; ?>',
                id_etiqueta: '<?php echo $dataEvento['id_etiquetas']; ?>',
                id_estado: '<?php echo $dataEvento['id_estado']; ?>'
                },
            <?php } ?>
        ],

        // Eliminar Evento
        eventRender: function(event, element) {
            element
                .find(".fc-content")
                .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
            
            // Eliminar evento
            element.find(".closeon").on("click", function() {
                var pregunta = confirm("¿Deseas Borrar este Evento?");   
                if (pregunta) {
                    $("#calendar").fullCalendar("removeEvents", event._id);

                    $.ajax({
                        type: "POST",
                        url: 'deleteEvento.php',
                        data: {id: event._id},
                        success: function(datos) {
                            $(".alert-danger").show();

                            setTimeout(function () {
                                $(".alert-danger").slideUp(500);
                            }, 3000); 
                        }
                    });
                }
            });
        },

        // Moviendo Evento Drag - Drop
        eventDrop: function (event, delta) {
            var idEvento = event._id;
            var start = event.start.format('YYYY-MM-DDTHH:mm:ss');
            var end = event.end.format('YYYY-MM-DDTHH:mm:ss');

            $.ajax({
                url: 'drag_drop_evento.php',
                data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
                type: "POST",
                success: function (response) {
                    // $("#respuesta").html(response);
                }
            });
        },

        // Modificar Evento del Calendario 
        eventClick: function(event) {
  var idEvento = event._id;
  $('input[name=idEvento]').val(idEvento);
  $('input[name=evento]').val(event.title);
  $('input[name=descripcion]').val(event.descripcion);
  $('input[name=archivo_actual]').val(event.fotografia); // Actualiza el campo con la ruta del archivo actual
  $('#archivo_actual_link').attr('href', event.fotografia).text(event.fotografia); // Muestra el enlace al archivo actual
  $('input[name=fecha_inicio]').val(event.start.format('YYYY-MM-DDTHH:mm:ss'));
  $('input[name=fecha_fin]').val(event.end.format('YYYY-MM-DDTHH:mm:ss'));
  $('select[name=id_etiqueta]').val(event.id_etiqueta);
  $('select[name=id_estado]').val(event.id_estado);
  $('select[name=id_usuario]').val(event.id_usuario);
  $("#modalUpdateEvento").modal();
           
        }
    });

    // Oculta mensajes de Notificacion
    setTimeout(function () {
        $(".alert").slideUp(300);
    }, 3000); 
});

</script>

    </section>
</main>



</body>
</html>
