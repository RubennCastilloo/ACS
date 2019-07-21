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
<body onload="emptyCode();">
  <script type="text/javascript">
    function addCode(key){
        var code = document.forms[0].code;
        if(code.value.length < 4){
            code.value = code.value + key;
        }
        if(code.value.length == 4){
            document.getElementById("message").style.display = "block";
            console.log(code.value);
            //Registrar Hora
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59

                if(h == 0){
                    h = 12;
                }

                if(h > 12){
                    h = h - 12;
                }

              h = (h < 10) ? "0" + h : h;
              m = (m < 10) ? "0" + m : m;
              s = (s < 10) ? "0" + s : s;

            var horario = h + ":" + m + ":" + s + " ";
            console.log(horario);


          var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
          var f=new Date();
          const fecha = (diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

            const usuarioRegistro = code.value,
                  // passwordRegistro = document.querySelector('#password-login').value
                  horaRegistro = horario,
                  fechaRegistro = fecha;


                  if (usuarioRegistro === '') {
                    notificacionFlotante('error', 'Todos los campos son obligatorios');
                  } else {
                    const datosRegistro = new FormData();

                    datosRegistro.append('usuario', usuarioRegistro);
                    // datosRegistro.append('password', passwordRegistro);
                    datosRegistro.append('hora', horaRegistro);
                    datosRegistro.append('fecha', fechaRegistro);

                    //Crear el objeto
                    const xhr = new XMLHttpRequest();

                    //Abrir la conexion
                    xhr.open('POST', 'inc/model/modelo-registro.php', true);

                    //Pasar los datos
                    xhr.onload = function() {
                      if (this.status === 200) {

                    const respuesta = JSON.parse(xhr.responseText);
                    // console.log(respuesta);
                    if (respuesta.respuesta === 'correcto') {
                      const hora = respuesta.hora;

                      notificacionFlotante('success', 'Registro Correcto ' + hora);
                      // document.querySelector('form').reset();
                      emptyCode();
                    }
                    if (respuesta.respuesta === 'incorrecto') {
                      const usuario = respuesta.usuario;
                      notificacionFlotante('error', 'Password Incorrecto para "' + usuario + '"');
                    }
                    if (respuesta.respuesta === 'inactivo') {
                      console.log(respuesta);
                      const usuario = respuesta.usuario;
                      notificacionFlotante('error', 'Emplead@ "'+ usuario +'" Inactivo');
                      emptyCode();
                    }
                    if (respuesta.respuesta === 'noexiste') {
                      notificacionFlotante('error', 'Empleado No Existe');
                      emptyCode();
                    }

                }
            }
            xhr.send(datosRegistro);
             }

          }



    }

    function submitForm(){
        document.getElementById("message").style.display = "none";
    }

    function emptyCode(){
        document.forms[0].code.value = "";
        setTimeout(submitForm,2000);

    }
    </script>
    <style>

    #keypad {margin:auto; margin-top:20px;}

    #keypad tr td {
        vertical-align:middle;
        text-align:center;
        border:1px solid #000000;
        font-size:18px;
        font-weight:bold;
        width:60px;
        height:40px;
        cursor:pointer;
        background-color:#666666;
        color:#CCCCCC;}
    #keypad tr td:hover {background-color:#999999; color:#FFFF00;}

    .display {
        width:200px;
        margin:10px auto auto auto;
        background-color:#000000;
        color:#00FF00;
        font-size: 35px;
        border:1px solid #999999;
    }
    #message {
        text-align:center;
        color:#009900;
        font-size:14px;
        font-weight:bold;
        display:none;
    }
    </style>
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
                                <td onclick="addCode('#');">#</td>
                            </tr>
                        </table>
                 </div>
                 <div class="campo-registro">

                </div>
    </form>
</div>




<?php include 'layout/footer.php'; ?>
