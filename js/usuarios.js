function init(){
  listar_usuarios_lenti();
}

//GENERANDO CODIGO PARA EMPLEADOS DE LENTI
function get_codigo_usuario(){
  $.ajax({
    url:"../ajax/usuarios.php?op=get_codigo_usuario",
    method:"POST",
    //data:{},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);
      $("#codigo_user").val(data.correlativo);  
      }
    });
}

function guardar_usuario(){
  let codigo = $("#codigo_user").val();
  let nombre = $("#nombre").val();
  let telefono = $("#telefono").val();
  let direccion = $("#direccion").val();
  let correo = $("#correo").val();
  let dui = $("#dui").val();
  let nit = $("#nit").val();
  let usuario = $("#usuario").val();
  let pass = $("#pass").val();
  let nick = $("#nick").val();
  let isss = $("#isss").val();
  let afp = $("#afp").val();
  let cuenta = $("#cuenta").val();
  let estado = $("#estado").val();
  let fecha_ingreso = $("#fecha").val();

  if(codigo !="" && telefono !=""){
    $.ajax({
      url:"../ajax/usuarios.php?op=guardar_usuario",
      method:"POST",
      data:{codigo:codigo,nombre:nombre,telefono:telefono,direccion:direccion,correo:correo,dui:dui,nit:nit,usuario:usuario,pass:pass,nick:nick,isss:isss,afp:afp,cuenta:cuenta,estado:estado,fecha_ingreso:fecha_ingreso},
      cache:false,
      dataType: "json",
      error:function(x,y,z){
        d_pacole.log(x);
        console.log(y);
        console.log(z);
      },
      success:function(data){
        console.log(data);
        if(data=='error'){
          Swal.fire('Usuario no se guardó','','error')
          return false;
        }else if (data=='ok'){
          Swal.fire('El usuario ha sido creado','','success')
          setTimeout("explode();", 2000);
        }else{
          Swal.fire('Modificación ha sido un éxito','','success')
          setTimeout("explode();", 2000);
        }
      }
    });
  }
  Swal.fire('Debe llenar todos los campos','','error')
}

///LISTAR usuarios del sistema
  function listar_usuarios_lenti(){

    $("#datatable_usuarios").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      dom: 'Bfrtip',
      "buttons": [ "excel"],
      "searching": true,
      "ajax":
      {
        url: "../ajax/usuarios.php?op=listar_usuarios_lenti",
        type : "post",
        dataType : "json",        
        error: function(e){
          //console.log(e.responseText);  
        } 
      },
      "language": {
        "sSearch": "Buscar:"
      }
    }).buttons().container().appendTo('#dt_usuarios_wrapper .col-md-6:eq(0)');

  }

init();