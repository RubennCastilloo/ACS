<?php

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
<body onload="emptyCode();">
    <style>

   
    </style>
<div class="navegacion-principal">
    <nav class="nav">
        <div class="logo">
            <a href="sistema.php"><img src="img/logo-blanco.png" alt="Logo RAIV" class="logo-nav"></a>
        </div>
                    <!-- <ul class="menu-full">
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
        </div> -->
</div>

<div class="contenedor-empleados">
    <form class="formulario-empleados" action="code.htm" method="get">
                <div class="campos-registro">
                    <div class="campo-registro">
                        <label for="nombres">Horario</label>
                        <!-- <div class="input-campo horario" id="time"></div> -->
                        <div id="reloj" class="clock" onload="showTime()"></div>
                    </div>
                    <input type="text" name="code" value="" maxlength="4" class="display" readonly="readonly" />
                                <p id="message">Registrando...</p>
                        <table id="keypad" cellpadding="5" cellspacing="3">
                            <tr>
                                <td onclick="addCode('1');">1</td>
                                <td onclick="addCode('2');">2</td>
                                <td onclick="addCode('3');">3</td>
                            </tr>
                            <tr>
                                <td onclick="addCode('4');">4</td>
                                <td onclick="addCode('5');">5</td>
                                <td onclick="addCode('6');">6</td>
                            </tr>
                            <tr>
                                <td onclick="addCode('7');">7</td>
                                <td onclick="addCode('8');">8</td>
                                <td onclick="addCode('9');">9</td>
                            </tr>
                            <tr>
                                <td onclick="addCode('*');">*</td>
                                <td onclick="addCode('0');">0</td>
                                <td class='delete-btn'><i class="fas fa-backspace"></i></td>
                            </tr>
                        </table>
                 </div>
                 <div class="campo-registro">

                </div>
    </form>
</div>




<?php include 'layout/footer.php'; ?>
