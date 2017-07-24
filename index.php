<?php
 session_start();
    if (isset($_SESSION['id'])) {
         header("Location: admin.php");
    }
    $dbError = "";
    require 'db.php';
    if (isset($_POST['user'])) {
            $query = $db->query("CALL spSelInicioSesion('".$_POST['user']."','".$_POST['pass']."')");
            $row =  $query->fetchAll(PDO::FETCH_NUM);
            $estado = $row[0][0];

            switch ($estado) {
                    case  1:
                        $_SESSION["id"] = $row[0][1];
                        $_SESSION["nombre"] = $row[0][2];
                        $_SESSION["correo"] = $row[0][3];
                        header('Location: admin.php');
                    break;
                    case  2:
                        $dbError='<div class="alert alert-warning"><strong>Warning!</strong> Error Usuario y/o Contrasena incorrecta.</div>';
                    break;
                    case  3:
                        $_SESSION["id"] = $row[0][1];
                        $_SESSION["nombre"] = $row[0][2];
                        $_SESSION["correo"] = $row[0][3];
                        header('Location: admin.php');
                        //header('Location: cambioContrasena.php');
                    break;
                
                default:
                    # code...
                    break;
            }

            
                
            
    }

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TCI | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src="img/tci/L1.png" width="100%">
                <!-- Poner las letras del logo mas oscuras. -->

            </div>
            <form class="m-t" role="form" action="" method="post">
                <div class="form-group">
                    <input name="user" type="text" class="form-control" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input name="pass" type="password" class="form-control" placeholder="contraseña" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Entrar</button>
                <?php echo $dbError; ?>

                <a href="#"><small>¿Olvidaste tu contraseña?</small></a>
                <p class="text-muted text-center"><small>¿Aun no tienes una cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Crear cuenta</a>
            </form>
            <p class="m-t"> <small>Tramitaciones de Comercio Intercontinental &copy; 2017</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
