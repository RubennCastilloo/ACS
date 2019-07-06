<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Roboto|ZCOOL+QingKe+HuangYou" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/mobile.css">
    <title>RAIV Technologies :: Control de Asistencia</title>
</head>
<body>
<div class="navegacion-principal">
    <nav class="nav">
        <div class="logo">
            <a href="index.php"><img src="img/logo-blanco.png" alt="Logo RAIV" class="logo-nav"></a>
        </div>
                <ul class="menu-full">
                <div class="container-movil" onclick="navegacionMovil(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
        <ul class="lista-nav movil">
            <li><a href="sistema.php">Sistema CA</a></li>
            <li><a href="empleados.php">Empleados</a></li>
            <li><a href="asistencias.php">Asistencias</a></li>
            <li><a href="horarios.php">Horarios</a></li>
            <li><a href="administrador.php">Administradores</a></li>
            <li><a href="login.php?cerrar_sesion=true" class="cerrar-sesion">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <div class="navegacion-movil">
                <ul class="oculto responsive" id="menu-responsive">
                    <li><a href="sistema.php">Sistema CA</a></li>
                    <li><a href="empleados.php">Empleados</a></li>
                    <li><a href="asistencias.php">Asistencias</a></li>
                    <li><a href="horarios.php">Horarios</a></li>
                    <li><a href="administrador.php">Administradores</a></li>
                    <li><a href="login.php?cerrar_sesion=true" class="cerrar-sesion">Cerrar Sesión</a></li>        
                </ul>
        </div>
</div>