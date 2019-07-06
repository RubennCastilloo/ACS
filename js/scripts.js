const crearAdmin = document.querySelector('#crear-admin'),
      crearHorario = document.querySelector('#crear-horario'),
      filtrarEmpleado = document.querySelector('#filtrar-empleado'),
      crearEmpleado = document.querySelector('#crear-empleado'),
      crearRegistro = document.querySelector('#crear-registro'),
      sinEspacioUsuario = document.querySelector("#usuario"),
      timeDisplay = document.querySelector("#time"),
      sinEspacioUsuarioLogin = document.querySelector('#usuario-login'),
      sinEspacioUsuarioAdmin = document.querySelector('#usuario-admin'),
      iniciarSesion = document.querySelector('#login'),
      listadoEmpleados = document.querySelector('#listado-empleados tbody'),
      listadoAdministadores = document.querySelector('#listado-administradores tbody'),
      listadoHorarios = document.querySelector('#listado-horarios tbody'),
      editarEmpleado = document.querySelector('.editar-empleado'),
      inputBuscador = document.querySelector('#buscar'),
      tablaAsistencias = document.querySelector('#lista-asistencias'),
      botonIp = document.querySelector('#mostrar-ip');


eventListeners();
showTime();


function notificacionFlotante(tipo, texto) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      
      Toast.fire({
        type: tipo,
        title: texto
      })
}

function eventListeners() {

  if (crearAdmin) {
    crearAdmin.addEventListener('click', leerFormularioAdmin);
  }
  if (crearHorario) {
    crearHorario.addEventListener('click', leerFormularioHorario);
  }
  if (filtrarEmpleado) {
    filtrarEmpleado.addEventListener('click', leerFiltrarEmpleado);
  }
  if (crearEmpleado) {
    crearEmpleado.addEventListener('click', leerFormularioEmpleado);
  }
  if (crearRegistro) {
    crearRegistro.addEventListener('click', leerRegistro);
  }
  if (sinEspacioUsuario) {
    sinEspacioUsuario.addEventListener('keyup', sinEspacio);
  }
  if (timeDisplay) {
    function refreshTime() {

      var dateString = new Date().toLocaleString("es-MX", {timeZone: "America/Chihuahua"});
      var formattedString = dateString.replace(", ", " - ");
      timeDisplay.innerHTML = formattedString;
    }
    setInterval(refreshTime, 1000);
  }
  if (sinEspacioUsuarioLogin) {
    sinEspacioUsuarioLogin.addEventListener('keyup', sinEspacio);
  }
  if (sinEspacioUsuarioAdmin) {
    sinEspacioUsuarioAdmin.addEventListener('keyup', sinEspacio);
  }
  if (iniciarSesion) {
    iniciarSesion.addEventListener('click', validarLogin);
  }
  //Listener para eliminar el boton
  if (listadoEmpleados) {
    listadoEmpleados.addEventListener('click', eliminarEmpleado);
  }
  if (listadoHorarios) {
    listadoHorarios.addEventListener('click', eliminarHorario);
  }
  if (editarEmpleado) {
    editarEmpleado.addEventListener('click', leerEditarEmpleado);
  }
  if (listadoAdministadores) {
    listadoAdministadores.addEventListener('click', eliminarAdministrador);
  }
  // if (inputBuscador) {
  //   inputBuscador.addEventListener('input', buscarRegistros);
  // }
  if (botonIp) {
    botonIp.addEventListener('click', mostrarIP);
  }
  
   
}

function leerFormularioAdmin(e) {
    e.preventDefault();

    const nombresAdmin = document.querySelector('#nombres-admin').value,
          apellidoPAdmin = document.querySelector('#apellido-paterno-admin').value,
          apellidoMAdmin = document.querySelector('#apellido-materno-admin').value,
          usuarioAdmin = document.querySelector('#usuario-admin').value,
          passwordAdmin = document.querySelector('#password-admin').value,
          departamentoAdmin = document.querySelector('#departamento-admin').value;

          if (nombresAdmin === '' || apellidoPAdmin === '' || apellidoMAdmin === '' || usuarioAdmin === '' || passwordAdmin === '' || departamentoAdmin === '') {
            notificacionFlotante('error', 'Todos los campos son obligatorios');
          } else {
            //Pasa la validacion
            const datosAdmin = new FormData();
            datosAdmin.append('nombres', nombresAdmin);
            datosAdmin.append('apellido-paterno', apellidoPAdmin);
            datosAdmin.append('apellido-materno', apellidoMAdmin);
            datosAdmin.append('usuario', usuarioAdmin);
            datosAdmin.append('password', passwordAdmin)
            datosAdmin.append('departamento', departamentoAdmin);

            //Crear el objeto
  const xhr = new XMLHttpRequest();

  //Abrir la conexion
  xhr.open('POST', 'inc/model/modelo-admin.php', true);

  //Pasar los datos
  xhr.onload = function() {
      if (this.status === 200) {

          const respuesta = JSON.parse(xhr.responseText);
          // console.log(respuesta);

          if (respuesta.respuesta === 'existe') {
            const usuarioNotificacion = respuesta.usuario;
            notificacionFlotante('error', 'Administrador "'+usuarioNotificacion+'" Existe');
          }
          if (respuesta.respuesta === 'correcto') {
            notificacionFlotante('success', 'Administrador "'+nombresAdmin+'" Creado Correctamente');

            const nuevoAdmin = document.createElement('tr');
            nuevoAdmin.innerHTML = `
              <td>${respuesta.nombres}</td>
              <td>${respuesta.apellido_paterno}</td>
              <td>${respuesta.usuario}</td>
              <td>${respuesta.departamento}</td>
            `;

            //Contenedor para los botones
            const contenedorAcciones = document.createElement('td');

            //Crear el icono de editar
            const iconoEditar = document.createElement('i');
            iconoEditar.classList.add('fas', 'fa-pen');

            //Crear el icono de eliminar
            const iconoEliminar = document.createElement('i');
            iconoEliminar.classList.add('fas', 'fa-trash');

            //Crear el boton de eliminar
            const btnEliminar = document.createElement('button');
            btnEliminar.appendChild(iconoEliminar);
            btnEliminar.setAttribute('data-id', respuesta.id_insertado);
            btnEliminar.classList.add('btn', 'btn-borrar');

            //Agregarlo al padre
            contenedorAcciones.appendChild(btnEliminar);

            //Agregarlo al TR
            nuevoAdmin.appendChild(contenedorAcciones);

            //Agregarlo con los empleados
            listadoAdministadores.appendChild(nuevoAdmin);

            
            document.querySelector('form').reset();
          }

      }
    } 
    xhr.send(datosAdmin);
  }   
}

function leerFormularioHorario(e) {
  e.preventDefault();

  const horaEntrada = document.querySelector('#hora-entrada').value,
        horaSalida = document.querySelector('#hora-salida').value,
        dias = document.querySelector('#dias').value;

        if (horaEntrada === '' || horaSalida === '' || dias === '') {
          notificacionFlotante('error', 'Todos los campos son obligatorios');
        } else {
          
          const datosHorario = new FormData();
          datosHorario.append('hora_entrada', horaEntrada);
          datosHorario.append('hora_salida', horaSalida);
          datosHorario.append('dias', dias);

              //Crear el objeto
              const xhr = new XMLHttpRequest();

              //Abrir la conexion
              xhr.open('POST', 'inc/model/modelo-horario.php', true);

              //Pasar los datos
              xhr.onload = function() {
                  if (this.status === 200) {

                      const respuesta = JSON.parse(xhr.responseText);
                      // console.log(respuesta);
                      if (respuesta.respuesta === 'correcto') {
                        notificacionFlotante('success', 'Horario Creado Correctamente');

                        const nuevoHorario = document.createElement('tr');
                        nuevoHorario.innerHTML = `
                          <td>${respuesta.hora_entrada}</td>
                          <td>${respuesta.hora_salida}</td>
                          <td>${respuesta.dias}</td>
                          <td>${respuesta.id_insertado}</td>
                          <td>${respuesta.id_insertado}</td>
                        `;

                        //Contenedor para los botones
                        const contenedorAcciones = document.createElement('td');

                        //Crear el icono de eliminar
                        const iconoEliminar = document.createElement('i');
                        iconoEliminar.classList.add('fas', 'fa-trash');

                        //Crear el boton de eliminar
                        const btnEliminar = document.createElement('button');
                        btnEliminar.appendChild(iconoEliminar);
                        btnEliminar.setAttribute('data-id', respuesta.id_insertado);
                        btnEliminar.classList.add('btn', 'btn-borrar');

                        //Agregarlo al padre
                        contenedorAcciones.appendChild(btnEliminar);

                        //Agregarlo al TR
                        nuevoHorario.appendChild(contenedorAcciones);

                        //Agregarlo con los empleados
                        listadoHorarios.appendChild(nuevoHorario);

                        document.querySelector('form').reset();

                      }
                      if (respuesta.respuesta === 'error') {
                        notificacionFlotante('error', 'Houston tenemos un problema');
                      }

                  }
              } 
          xhr.send(datosHorario);
          }
}

function leerFiltrarEmpleado(e) {
  e.preventDefault();

  const buscarEmpleado = document.querySelector('#buscar-empleado').value,
        deFecha = document.querySelector('#de-fecha').value,
        aFecha = document.querySelector('#a-fecha').value;

        if (buscarEmpleado === 'seleccionar' || deFecha === '' || aFecha === '') {
          notificacionFlotante('error', 'No se ha seleccionado parametro');
        } else {

          const datosBuscar = new FormData();
          datosBuscar.append('nombres', buscarEmpleado);
          datosBuscar.append('de-fecha', deFecha);
          datosBuscar.append('a-fecha', aFecha);

          //Crear el objeto
          const xhr = new XMLHttpRequest();

          //Abrir la conexion
          xhr.open('POST', 'inc/model/modelo-buscar.php', true);

          //Pasar los datos
          xhr.onload = function() {
            if (this.status === 200) {

          const respuesta = JSON.parse(xhr.responseText);
          // console.log(respuesta);

         

      }
  } 
  xhr.send(datosBuscar);

        }
}

function leerFormularioEmpleado(e) {
  e.preventDefault();

  const nombresEmpleado = document.querySelector('#nombres').value,
        apellidoPEmpleado = document.querySelector('#apellido-paterno').value,
        apellidoMEmpleado = document.querySelector('#apellido-materno').value,
        usuarioEmpleado = document.querySelector('#usuario').value,
        passwordEmpleado = document.querySelector('#password').value,
        departamentoEmpleado = document.querySelector('#departamento').value,
        puestoEmpleado = document.querySelector('#puesto').value,
        horarioEmpleado = document.querySelector('#horario').value,
        estadoEmpleado = document.querySelector('#activo').checked;

        if (estadoEmpleado === true) {
          estadoEmpleadoDatos = 'activo';
        } else {
          estadoEmpleadoDatos = 'inactivo';
        }

        if (nombresEmpleado === '' || apellidoPEmpleado === '' || apellidoMEmpleado === '' || usuarioEmpleado === '' || passwordEmpleado === '' || departamentoEmpleado === '' || puestoEmpleado === '' || horarioEmpleado === 'Seleccionar') {
          notificacionFlotante('error', 'Todos los campos son obligatorios');
        } else {
          const datosEmpleado = new FormData();
          datosEmpleado.append('nombres', nombresEmpleado);
          datosEmpleado.append('apellido_paterno', apellidoPEmpleado);
          datosEmpleado.append('apellido_materno', apellidoMEmpleado);
          datosEmpleado.append('usuario', usuarioEmpleado);
          datosEmpleado.append('password', passwordEmpleado);
          datosEmpleado.append('departamento', departamentoEmpleado);
          datosEmpleado.append('puesto', puestoEmpleado);
          datosEmpleado.append('horario', horarioEmpleado);
          datosEmpleado.append('estado', estadoEmpleadoDatos);


          //Crear el objeto
          const xhr = new XMLHttpRequest();

          //Abrir la conexion
          xhr.open('POST', 'inc/model/modelo-empleado.php', true);

          //Pasar los datos
          xhr.onload = function() {
            if (this.status === 200) {

          const respuesta = JSON.parse(xhr.responseText);
          // console.log(respuesta);

          if (respuesta.respuesta === 'correcto') {
            notificacionFlotante('success', 'Empleado Creado Correctamente');

            const nuevoEmpleado = document.createElement('tr');
            nuevoEmpleado.innerHTML = `
              <td>${respuesta.nombres}</td>
              <td>${respuesta.apellido_paterno}</td>
              <td>${respuesta.usuario}</td>
              <td>${respuesta.estado}</td>
              <td>${respuesta.horario}</td>
            `;

            //Contenedor para los botones
            const contenedorAcciones = document.createElement('td');

            //Crear el icono de editar
            const iconoEditar = document.createElement('i');
            iconoEditar.classList.add('fas', 'fa-pen');
            
            //crea el enlace para editar
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);
            btnEditar.href = `editar-empleado.php?id=${respuesta.id_insertado}`;
            btnEditar.classList.add('btn-editar', 'btn');

            //Agregarlo al padre
            contenedorAcciones.appendChild(btnEditar);

            //Crear el icono de eliminar
            const iconoEliminar = document.createElement('i');
            iconoEliminar.classList.add('fas', 'fa-trash');

            //Crear el boton de eliminar
            const btnEliminar = document.createElement('button');
            btnEliminar.appendChild(iconoEliminar);
            btnEliminar.setAttribute('data-id', respuesta.id_insertado);
            btnEliminar.classList.add('btn', 'btn-borrar');

            //Agregarlo al padre
            contenedorAcciones.appendChild(btnEliminar);

            //Agregarlo al TR
            nuevoEmpleado.appendChild(contenedorAcciones);

            //Agregarlo con los empleados
            listadoEmpleados.appendChild(nuevoEmpleado);






            document.querySelector('form').reset();
          }
          if (respuesta.respuesta === 'existe') {
            notificacionFlotante('error', 'El empleado ya esta registrado');
          }
          if (respuesta.respuesta === 'error') {
            notificacionFlotante('error', 'Houston Tenemos un problema');
          }

      }
  } 
  xhr.send(datosEmpleado);


        }

}

function leerRegistro(e) {
  e.preventDefault();

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

  const usuarioRegistro = document.querySelector('#usuario-login').value,
        passwordRegistro = document.querySelector('#password-login').value
        horaRegistro = horario;
        fechaRegistro = fecha;
        

        if (usuarioRegistro === '' || passwordRegistro === '') {
          notificacionFlotante('error', 'Todos los campos son obligatorios');
        } else {
          const datosRegistro = new FormData();
          
          datosRegistro.append('usuario', usuarioRegistro);
          datosRegistro.append('password', passwordRegistro);
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
            document.querySelector('form').reset();
          }  
          if (respuesta.respuesta === 'incorrecto') {
            const usuario = respuesta.usuario;
            notificacionFlotante('error', 'Password Incorrecto para "' + usuario + '"');
          }
          if (respuesta.respuesta === 'inactivo') {
            const usuario = respuesta.usuario;
            notificacionFlotante('error', 'Emplead@ "'+ usuario +'" Inactivo');
          }
          if (respuesta.respuesta === 'noexiste') {
            notificacionFlotante('error', 'Empleado No Existe');
          }
          
      }
  } 
  xhr.send(datosRegistro);
   }

}

function sinEspacio(e) {
  let contenido = e.target.value;
  e.target.value = contenido.replace(" ", "");
}

function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59
  var session = "AM";
  
  if(h == 0){
      h = 12;
  }
  
  if(h > 12){
      h = h - 12;
      session = "PM";
  }
  
  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " " + session;

  const reloj = document.getElementById("reloj")

  if (reloj) {
    reloj.innerText = time;
    reloj.textContent = time;
  }
  
  
  setTimeout(showTime, 1000);
  
}

function soloNumeros(e){
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " 0123456789";
  especiales = [8,37,39,46];

  tecla_especial = false
  for(var i in especiales){
if(key == especiales[i]){
   tecla_especial = true;
   break;
      } 
  }

  if(letras.indexOf(tecla)==-1 && !tecla_especial)
      return false;
}

function validarLogin(e) {
  e.preventDefault();

  const usuarioLogin = document.querySelector('#usuario-login').value,
        passwordLogin = document.querySelector('#password-login').value;

        if (usuarioLogin === '' || passwordLogin === '') {
          notificacionFlotante('error', 'Todos los campos son obligatorios');
        } else {

          const datosLogin = new FormData();
          datosLogin.append('usuario', usuarioLogin);
          datosLogin.append('password', passwordLogin);

          //Crear el objeto
          const xhr = new XMLHttpRequest();

          //Abrir la conexion
          xhr.open('POST', 'inc/model/modelo-login.php', true);

          //Pasar los datos
          xhr.onload = function() {
            if (this.status === 200) {

          const respuesta = JSON.parse(xhr.responseText);
          // console.log(respuesta);
          
          if (respuesta.respuesta === 'correcto') {
            notificacionFlotante('success', 'Login Correcto');
            setTimeout(() => {
              window.location.href = 'index.php';
            }, 2500);
          }
          if (respuesta.respuesta === 'incorrecto') {
            notificacionFlotante('error', 'Password Incorrecto');
          }
          if (respuesta.respuesta === 'noexiste') {
            notificacionFlotante('error', 'No existe el Administrador');
          }

      }
  } 
  xhr.send(datosLogin);
        }
}

function eliminarEmpleado(e) {
 
  if (e.target.parentElement.classList.contains('btn-borrar')) {
    //Tomar el ID
    const id = e.target.parentElement.getAttribute('data-id');
    
    //Preguntar al usuario si estan seguros

    Swal.fire({
      title: '¿Estas seguro(a)?',
      text: "Esta acción no se podrá deshacer",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#1d9e19',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        
          const xhr = new XMLHttpRequest();
          
          xhr.open('GET', `inc/model/modelo-borrar.php?id=${id}`, true);

          xhr.onload = function() {
            if (this.status === 200) {
              const respuesta = JSON.parse(xhr.responseText);
              // console.log(respuesta);
              if (respuesta.respuesta === 'correcto') {
                 //Eliminar el registro del DOM
                // console.log(e.target.parentElement.parentElement.parentElement);
                e.target.parentElement.parentElement.parentElement.remove();
                if (result.value) {
                  Swal.fire(
                    'Eliminado',
                    'Empleado eliminado correctamente',
                    'success'
                  )
                }
                
              }
              if (respuesta.respuesta === 'error') {
                if (result.value) {
                  Swal.fire(
                    'Error',
                    'Empleado cuenta con registros',
                    'error'
                  )
                }
              }
            }
          }

          xhr.send();
      }
    })
  }
}

function leerEditarEmpleado(e) {
  e.preventDefault();
  
  
  const nombresEmpleado = document.querySelector('#nombres').value,
        apellidoPEmpleado = document.querySelector('#apellido-paterno').value,
        apellidoMEmpleado = document.querySelector('#apellido-materno').value,
        usuarioEmpleado = document.querySelector('#usuario').value,
        passwordEmpleado = document.querySelector('#password').value,
        departamentoEmpleado = document.querySelector('#departamento').value,
        puestoEmpleado = document.querySelector('#puesto').value,
        horarioEmpleado = document.querySelector('#horario').value,
        estadoEmpleado = document.querySelector('#activo').checked,
        idRegistro = document.querySelector('#id').value;

        if (estadoEmpleado === true) {
          estadoEmpleadoDatos = 'activo';
        } else {
          estadoEmpleadoDatos = 'inactivo';
        }

        if (nombresEmpleado === '' || apellidoPEmpleado === '' || apellidoMEmpleado === '' || usuarioEmpleado === '' || passwordEmpleado === '' || departamentoEmpleado === '' || puestoEmpleado === '' || horarioEmpleado === 'Seleccionar') {
          notificacionFlotante('error', 'Todos los campos son obligatorios');
        } else {
          const datosEmpleado = new FormData();
          datosEmpleado.append('nombres', nombresEmpleado);
          datosEmpleado.append('apellido_paterno', apellidoPEmpleado);
          datosEmpleado.append('apellido_materno', apellidoMEmpleado);
          datosEmpleado.append('usuario', usuarioEmpleado);
          datosEmpleado.append('password', passwordEmpleado);
          datosEmpleado.append('departamento', departamentoEmpleado);
          datosEmpleado.append('puesto', puestoEmpleado);
          datosEmpleado.append('horario', horarioEmpleado);
          datosEmpleado.append('estado', estadoEmpleadoDatos);
          datosEmpleado.append('id', idRegistro);


          //Crear el objeto
          const xhr = new XMLHttpRequest();

          //Abrir la conexion
          xhr.open('POST', 'inc/model/editar-empleado.php', true);

          //Pasar los datos
          xhr.onload = function() {
            if (this.status === 200) {

          const respuesta = JSON.parse(xhr.responseText);
          // console.log(respuesta);
          if (respuesta.respuesta === 'correcto') {
            notificacionFlotante('success', 'Empleado editado correctamente');
            //Despues de 3 segundos reedireccionar
          setTimeout(() => {
            window.location.href = 'empleados.php';
          }, 3000);
          } 
          if (respuesta.respuesta === 'error') {
            notificacionFlotante('error', 'No se editó el empleado');
          }
        }
  } 
  xhr.send(datosEmpleado);


        }
}

function eliminarHorario(e) {
  if (e.target.parentElement.classList.contains('btn-borrar')) {
    //Tomar el ID
    const id = e.target.parentElement.getAttribute('data-id');
    //Preguntar al usuario si estan seguros

    Swal.fire({
      title: '¿Estas seguro(a)?',
      text: "Esta acción no se podrá deshacer",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#1d9e19',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        
          const xhr = new XMLHttpRequest();
          
          xhr.open('GET', `inc/model/borrar-horario.php?id=${id}`, true);

          xhr.onload = function() {
            if (this.status === 200) {
              const respuesta = JSON.parse(xhr.responseText);
              // console.log(respuesta);
              if (respuesta.respuesta === 'correcto') {
                 //Eliminar el registro del DOM
                // console.log(e.target.parentElement.parentElement.parentElement);
                e.target.parentElement.parentElement.parentElement.remove();
                if (result.value) {
                  Swal.fire(
                    'Eliminado',
                    'Empleado eliminado correctamente',
                    'success'
                  )
                }
                
              }
              if (respuesta.respuesta === 'error') {
                if (result.value) {
                  Swal.fire(
                    'Error',
                    'Empleado cuenta con registros',
                    'error'
                  )
                }
              }
            }
          }

          xhr.send();
      }
    })
  }
}

// function buscarRegistros(e) {
//   const expresion = new RegExp(e.target.value, "i" );
//           registros = document.querySelectorAll('tbody tr');
//           registros.forEach(registro => {
//                registro.style.display = 'none';

//                if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1 ){
//                     registro.style.display = 'table-row';
//                }
//           })
// }

function buscarContenido()
		{
			var tableReg = document.getElementById('datos');
			var searchText = document.getElementById('buscar').value.toLowerCase();
			var cellsOfRow="";
			var found=false;
			var compareWith="";
 
			// Recorremos todas las filas con contenido de la tabla
			for (var i = 1; i < tableReg.rows.length; i++)
			{
				cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
				found = false;
				// Recorremos todas las celdas
				for (var j = 0; j < cellsOfRow.length && !found; j++)
				{
					compareWith = cellsOfRow[j].innerHTML.toLowerCase();
					// Buscamos el texto en el contenido de la celda
					if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
					{
						found = true;
					}
				}
				if(found)
				{
					tableReg.rows[i].style.display = '';
				} else {
					// si no ha encontrado ninguna coincidencia, esconde la
          // fila de la tabla
          tableReg.rows[i].style.display = 'none';
          
				}
			}
}
    
function borrarInput(event) {

      var codigo = event.which || event.keyCode;
       
      if(codigo === 27){
        document.querySelector('form').reset();
      }
  
       
}
    
function eliminarAdministrador(e) {
  if (e.target.parentElement.classList.contains('btn-borrar')) {
    //Tomar el ID
    const id = e.target.parentElement.getAttribute('data-id');
    
    //Preguntar al usuario si estan seguros

    Swal.fire({
      title: '¿Estas seguro(a)?',
      text: "Esta acción no se podrá deshacer",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#1d9e19',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        
          const xhr = new XMLHttpRequest();
          
          xhr.open('GET', `inc/model/borrar-admin.php?id=${id}`, true);

          xhr.onload = function() {
            if (this.status === 200) {
              const respuesta = JSON.parse(xhr.responseText);
              // console.log(respuesta);
              if (respuesta.respuesta === 'correcto') {
                 //Eliminar el registro del DOM
                // console.log(e.target.parentElement.parentElement.parentElement);
                e.target.parentElement.parentElement.parentElement.remove();
                if (result.value) {
                  Swal.fire(
                    'Eliminado',
                    'Empleado eliminado correctamente',
                    'success'
                  )
                }
                
              }
              if (respuesta.respuesta === 'error') {
                if (result.value) {
                  Swal.fire(
                    'Error',
                    'No se puede eliminar el Administrador',
                    'error'
                  )
                }
              }
            }
          }

          xhr.send();
      }
    })
  }
}

function navegacionMovil(x) {
  x.classList.toggle("change");
  
  var menuResponsive = document.getElementById("menu-responsive");

    if (menuResponsive.className === "mostrar") {
      menuResponsive.className = "oculto";
    } else {
      menuResponsive.className = "mostrar";
    }
  
}

function mostrarIP(e) {
  e.preventDefault();

  const ipAPI = 'https://api.ipify.org?format=json'

Swal.queue([{
  title: 'Tu IP',
  confirmButtonText: 'Mostrar mi IP',
  text:
    'Tu IP sera recibida via ' +
    'AJAX',
  showLoaderOnConfirm: true,
  preConfirm: () => {
    return fetch(ipAPI)
      .then(response => response.json())
      .then(data => Swal.insertQueueStep(data.ip))
      .catch(() => {
        Swal.insertQueueStep({
          type: 'error',
          title: 'No se pudo obtener tu IP'
        })
      })
  }
}])
}

$('.send').on('click', function(){

  $.getJSON('https://ipapi.co/'+$('.ip').val()+'/json', function(data){
      $('.city').text(data.city);
      $('.country').text(data.country);
  });
});
