<?php
include 'inc/sesiones.php';
?>

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
            <a href="sistema.php"><img src="img/logo-blanco.png" alt="Logo RAIV" class="logo-nav"></a>
        </div>
                    <ul class="menu-full">
                <div class="container-movil" onclick="navegacionMovil(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
        <ul class="lista-nav movil">
            <li><a href="login.php?cerrar_sesion=true" class="cerrar-sesion">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <div class="navegacion-movil">
                <ul class="oculto responsive" id="menu-responsive">
                    <li><a href="login.php?cerrar_sesion=true" class="cerrar-sesion">Cerrar Sesión</a></li>
                </ul>
        </div>
</div>

<div class="contenedor-empleados">
    <form class="formulario-empleados">
                <div class="campos-registro">
                    <div class="campo-registro">
                        <label for="nombres">Horario</label>
                        <!-- <div class="input-campo horario" id="time"></div> -->
                        <div id="reloj" class="clock" onload="showTime()"></div>
                    </div>
                    <div class="campo-registro">
                        <label for="usuario-login">Usuario</label>
                        <input
                            type="text"
                            class="input-campo"
                            placeholder="Usuario"
                            id="usuario-login"
                        >
                    </div>
                    <div class="campo-registro">
                        <label for="password-login">Contraseña</label>
                        <input
                            type="password"
                            class="input-campo"
                            placeholder="Password"
                            id="password-login"
                        >
                    </div>
                 </div>
                 <div class="campo-registro">
                        <input type="submit" class="btn-registrar" id="crear-registro" value="Registrar">
                </div>
    </form>
</div>




<?php include 'layout/footer.php'; ?>
