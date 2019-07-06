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
<?php 
    session_start();
    if(isset($_GET['cerrar_sesion'])) {
        //   echo "Si, presionaste en cerrar";
        $_SESSION = array ();
      }
?>
<body>

    <div class="contenedor-login">
        <div class="login">
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
                    <div class="campo-registro">
                        <input type="submit" class="btn-registrar" id="login" value="Iniciar Sesión">
                    </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="js/scripts.js"></script>       
</body>
</html>