<?php
session_start();
$_SESSION['date'] = date("Y/m/d");
if (!isset($_SESSION['id']) ){
    header("Location: index.php");
    die;
}
 require 'db.php';
if ( isset($_GET['m']) ){
    switch($_GET['m']) {

        /* clientes */
         /* reportes */
        //este primer case es para el reporte de Martin
        /*case "reportes":
            $paginaPHP = "php/reportes.php";
        break;*/
        case "clientes":
            $paginaPHP = "php/clientes.php";
        break;
        case "clientesAgregar":
            $paginaPHP = "php/clientesAgregar.php";
        break;
        case "clientesEditar":
            $paginaPHP = "php/clientesEditar.php";
        break;

        case "busquedaInv":
            $paginaPHP = "php/busqueda.php";
        break;
        case "clienteCitas":
            $paginaPHP = "php/clienteCitas.php";
        break;

        /* citas */
        case "CrucesAgregar":
            $paginaPHP = "php/CrucesAgregar.php";
        break;
        case "citasAgregar":
            $paginaPHP = "php/citasAgregar.php";
        break;
        case "citasEditar":
            $paginaPHP = "php/citasEditar.php";
        break;

        
        /* punto de venta */
        case "exportacion":
            $paginaPHP = "php/phillips.php";
        break;
        case "pventaAgregar":
            $paginaPHP = "php/pventaAgregar.php";
        break;
        case "pventaEditar":
            $paginaPHP = "php/pventaEditar.php";
        break;

        /* liquidar */
        case "liquidar":
            $paginaPHP = "php/liquidar.php";
        break;

        /* categorias */
        case "categorias":
            $paginaPHP = "php/categorias.php";
        break;
        case "categoriasAgregar":
            $paginaPHP = "php/categoriasAgregar.php";
        break;
        case "categoriasEditar":
            $paginaPHP = "php/categoriasEditar.php";
        break;

        case "modificar":
            $paginaPHP = "php/modificar.php";
        break;

       
        case "reportescats":
            $paginaPHP = "php/reportescat.php";
        break;
        //reporte Miriam
        case "reportes":
            $paginaPHP = "php/reportesPed.php";
        break;


        /* usuarios */
        case "usuarios":
            $paginaPHP = "php/usuarios.php";
        break;
        case "usuariosAgregar":
            $paginaPHP = "php/usuariosAgregar.php";
        break;
        case "usuariosEditar":
            $paginaPHP = "php/usuariosEditar.php";
        break;

        /* Bitacora */
        case "bitacora":
            $paginaPHP = "php/bitacora.php";
        break;
    }
} else {
        $paginaPHP = "php/null.php";
}

$errorMsg = "";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TCI | Sistema </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
        <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.typeahead.js"></script>
     <script type="text/javascript">
    
    $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
        
    });

        </script>
    <script type="text/javascript" src="js/app.js"></script>
    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- Peity -->
    <script src="js/demo/peity-demo.js"></script>    
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="TCI" class="" src="img/tci/L2.png" style="width:100%" />

                            <span class="clear"> <span class="block m-t-xs"><center><strong class="font-bold" class="col-lg-6"><?php echo "Bienvenido ".$_SESSION["nombre"]; ?></strong></center> 
<!-- Agregar condicion en base a privilegios -->
                    </div>
                    <div class="logo-element">
                        <!-- agregar solo la t del logo en ves d elo de abajo -->
                        TCI
                    </div>
                </li>
                <li>
                    <a href="admin.php?m=null"><i class="fa fa-home"></i><span class="nav-label">Inicio</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Archivo Digital</span></a>
                </li>
                <li>
                    <a href="#"><i  class="fa fa-th-large"></i><span class="nav-label">Cruces y Cajas</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="admin.php?m=CrucesAgregar"><i class=""></i> <span class="nav-label">Agregar Cruces</span></a>
                        </li>
                        <li>
                            <a href="admin.php?m=busquedaInv"><i class=""></i> <span class="nav-label">Busqueda Cruces</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin.php?m=exportacion"><i class="fa fa-edit"></i> <span class="nav-label">Coves</span></a>
                </li>
                <li>
                    <a href=""><i  class="fa fa-star"></i><span class="nav-label">Catalogo</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#"><i class=""></i> <span class="nav-label">Clientes</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin.php?m=reportes"><i class="fa fa-files-o"></i> <span class="nav-label">Reportes</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orden de Compra</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-car"></i> <span class="nav-label">Transportadora</span></a>
                </li>
                <li>
                    <a href=""><i class="fa fa-laptop"></i><span class="nav-label">Configuraciones</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=""><i class=""></i><span class="nav-label">Bitacora</span></a></li>
                        <li><a href="admin.php?m=usuarios"><i class=""></i><span class="nav-label">Usuarios</span></a></li>
                        <li><a href=""><i class=""></i><span class="nav-label">Paginas</span></a></li>
                    </ul>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Paginas Web</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="www.tramitaciones.com">tramitaciones.com <span class="fa arrow"></span></a>
                        </li>
                        <li><a href="#">transportaciones.com</a></li>
                        <li>
                            <a href="#">tcilogistics.com</a></li>
                        <li>
                    </ul>
                </li>
              
            </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="">
                        <i class="fa fa-user-o  "></i> <?php echo $_SESSION['nombre']; ?>
                    </a>
                </li>
            </ul>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="cerrar.php">
                        <i class="fa fa-sign-out"></i> Cerrar Ses&iacute;on
                    </a>
                </li>
            </ul>
        </nav>
        </div>
            <?php include $paginaPHP; ?>
        <div class="footer">
            <div>
                <strong>Copyright</strong> Tramitaciones de comercio Intercontinental, S.C. 2017 
            </div>
        </div>

        </div>
        </div>




</body>

</html>
