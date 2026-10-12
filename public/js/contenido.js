//funcion ready------------------
//Esta funcion se ejecuta una vez que ya se cargo todo el contenido web (o la pagina)
//por eso es conveniente que toda la ejecucion d ela poagina se haga a partir de esta funcion
$(function () {
    initFuncionesGenerales();

    initButtonsOn();

    //ocultamos la animacion de carga
    loader(false); //el codigo js de cargador esta importado desde view/cargador.php
});

function initFuncionesGenerales(){
    //alert("funciones generales");
}


function initButtonsOn(){
     alert("funciones Button On");
}

function initButtonsOn() {
  


  
 





  //boton cargar configuracion usuario -----------------------------------------------------------
  $(document).on("click", "#btn_config_list_users", function (event) {
    cargarListaUsuarios();
   
  });


  //boton cargar configuracion usuario -----------------------------------------------------------
  $(document).on("click", "#btn_config_user_ejecutar_accion", function (event) {
     let usuario_accion = $("#hd_usuario_accion_seleccionada").val();
      
    let usuario_id = $("#hd_usuario_seleccionado").val();
    let nombre_usuario = $("#tb_config_user_nombre_usuario").val();
    let username = $("#tb_config_user_username").val();
    let password = $("#tb_config_user_password").val();
    let email = $("#tb_config_user_email").val();
    let direccion_ip = $("#tb_config_user_direccion_ip").val();
    let rol_id = $("#select_config_user_rol").val();
    let nivel_inicial = $("#tb_config_user_nivel_inicial").val();

      accionUsuario(usuario_accion, usuario_id, nombre_usuario, username, password, email, direccion_ip, rol_id, nivel_inicial);

  });

  //boton cargar lista de  configuracion usuario -----------------------------------------------------------
  $(document).on("click", "#btn_agregar_usuario", function (event) {
    //cargarListaUsuarios();
    mostrarModalAgregarUsuario();
    //alert("agregar usuarios");
  });

  
  //esta funcion es para editar el usuario seleccioando -----
  $(document).on("click", ".btn_editar_usuario", function () {

     const renglon = $(this).parent().parent();//apuntamos al renglos
    //esto se ocupa para componentes sin datatable ---
   
    // let num = renglon.find('td:nth-child(1)').text(); //es el numero de renglin en la tabla, lo ocupamos despues para obtener datos
    // let nombre_usuario = renglon.find('td:nth-child(2)').text();
    // let username = renglon.find('td:nth-child(3)').text();
    // let password = renglon.find('td:nth-child(4)').text();
    // let email = renglon.find('td:nth-child(5)').text();
    // let ip = renglon.find('td:nth-child(6)').text();
    // let rol_id = renglon.find('td:nth-child(7)').text("rol_id");
    // let nombre_rol = renglon.find('td:nth-child(7)').text();
    // let nivel_inicial = renglon.find('td:nth-child(8)').text();


    //es el numero de renglin en la tabla, lo ocupamos despues para obtener datos
    let num = renglon.find('td:nth-child(1)').text() -1; 

    //**IMPORTANTE********/
    //para componentes con datatable es con el api de datatable
     datatable_usuarios = $("#config_table_users").DataTable();
    //referenciamos el numero de renglon para poder accesar a los datos desde las funciones de la api de datatable
    let fila = datatable_usuarios.row(num);
    let datos = fila.data();
    let usuario_id = datos[0]; //el id 0 es la columna oculta con el id del registro, pa posicion 1 es el contador de renglon
    let num_reg = datos[1];
    let nombre_usuario = datos[2];
    let username = datos[3];
    let password = datos[4];
    let email = datos[5];
    let ip = datos[6];
    let rol_id = datos[7];
    let nombre_rol = datos[8];
    let nivel_inicial = datos[9];

    mostrarModalEditarUsuario(usuario_id, nombre_usuario, username, password, email, ip, rol_id, nivel_inicial);
  });

  //esta funcion es para borrar el usuario seleccioando -----
  $(document).on("click", ".btn_borrar_usuario", function () {
    const renglon = $(this).parent().parent();//apuntamos al renglos
    //es el numero de renglin en la tabla, lo ocupamos despues para obtener datos
    let num = renglon.find('td:nth-child(1)').text() -1; 
    //para componentes con datatable es con el api de datatable
     datatable_usuarios = $("#config_table_users").DataTable();
    //referenciamos el numero de renglon para poder accesar a los datos desde las funciones de la api de datatable
    let fila = datatable_usuarios.row(num);
    let datos = fila.data();
    let usuario_id = datos[0]; //el id 0 es la columna oculta con el id del registro, pa posicion 1 es el contador de renglon
    let num_reg = datos[1];
    let nombre_usuario = datos[2];
    let username = datos[3];
    let password = datos[4];
    let email = datos[5];
    let ip = datos[6];
    let rol_id = datos[7];
    let nombre_rol = datos[8];
    let nivel_inicial = datos[9];
    mostrarModalBorrarUsuario(usuario_id, nombre_usuario, username, password, email, ip, rol_id, nivel_inicial);
  });


  //boton configuracion general -----------------------------------------------------------
  $(document).on("click", "#btn_config", function (event) {
    cargarConfiguracion();
  });

  //boton cargar configuracion usuario -----------------------------------------------------------
  $(document).on("click", "#btn_config_guardar", function (event) {
    guardarConfiguracion();
  });

  //boton salir de la session -----------------------------------------------------------
  $(document).on("click", "#btn_logout", function (event) {
    alert("Salir");
  });

 

  

  

  
} //fin initButtons