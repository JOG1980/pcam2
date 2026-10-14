//funcion ready------------------
//Esta funcion se ejecuta una vez que ya se cargo todo el contenido web (o la pagina)
//por eso es conveniente que toda la ejecucion d ela poagina se haga a partir de esta funcion
$(function () {


    initButtonsOnMenu();
    initDataTableUsuarios();

    //ocultamos la animacion de carga
    loader(false); //el codigo js de cargador esta importado desde view/cargador.php
});

//## FUNCIONES DE INICIALIZACION ########################################################################
//inicializa datables de los usuarios -------------
//esta solo se llama una vez ya que siempre existe desde el inicio de la pagiva como elemento estatico
function initDataTableUsuarios() {

  //tabla de lista de usuarios
  datatable_usuarios = $("#config_table_users").DataTable({
    paging: false,
    info: false,
    lengthChange: false,
    searching: false,
    language: {
      emptyTable: "No hay archivos",
    },
    autoWidth: false,
    columnDefs: [
      { width: "auto", targets: 7 },
      { visible: false, targets: [0,7]}, //hace invisibles los campos numero de registro
      { orderable: false, targets: 9 }],
  }); //datatable_es-ES
}



//## FUNCIONES DE EVENTOS ON ########################################################################
function initButtonsOnMenu() {

  //boton cargar configuracion usuario -----------------------------------------------------------
  $(document).on("click", "#btn_config_list_users", function (event) {
        cargarListaUsuarios();
   
  });


} //fin initButtonsONMenu



//***************************************************************************************************************************** */
// FUNCIONES DE USUARIOS
//***************************************************************************************************************************** */
//funcion de carga de usuarios en el modal de configuracion de usuarios------------------------------------------------------------------
async function cargarListaUsuarios() {
  try {
    //ejrcutar cargador
    loader(true);

    const response = await fetch("?controller=usuarios&action=obtener", {
      method: "POST",
    });

    if (!response.ok) {
      throw new Error("Error en la petición");
    }

    const data = await response.json();
    //const data = await response.text();
//alert(JSON.stringify(data.registros));
    let contenido_usuarios = "";
    let usuarios = data.registros;

    $("#num_lista_usurios").text(usuarios.length);
    
    
     if (usuarios.length > 0) {

       datatable_usuarios = $("#config_table_users").DataTable();
      //limpiamos el componente datatable
      datatable_usuarios.clear();
       for (i = 0; i < usuarios.length; i++) {

        //alert(JSON.stringify(usuarios[i]));
        //let id = items[i].id;
        let id = usuarios[i].id;
        let num = i+1;
        let nombre = usuarios[i].nombre;
        let username = usuarios[i].username;
        let password = usuarios[i].password;
        let email = usuarios[i].email ?? ''; // el simbolo ??'' es que si no existe el valor (null) regresa ''
        let ip = usuarios[i].ip ?? '';
        let rol_id = usuarios[i].rol_id;
        let nombre_rol = usuarios[i].nombre_rol;

        let botones_usuario = "<button class='btn my_btn btn_editar_usuario' title='Editar usuario'><img src='./images/16x16/pencil.png' /></button>";
            botones_usuario +=   "<button class='btn my_btn btn_borrar_usuario' title='Borrar usuario'><img src='./images/16x16/cross.png' /></button>";
       
        
        datatable_usuarios.row.add([
              id,
              num, 
              nombre, 
              username, 
              password,
              email, 
              ip,
              rol_id, 
              nombre_rol,
              botones_usuario]);
        

       }
     }

    datatable_usuarios.draw(false);

    //$("#config_table_users tbody").html(contenido_usuarios);

    //inicializa el datatable de los usuario
    //initDataTableUsuarios();
    //var tabla = $("#config_table_users").DataTable();
    //tabla.draw();

    $("#configUserListModal").modal("show");

    //ejrcutar cargador
    loader(false);

  } catch (error) {
    console.error("Error:", error);
  }
}
