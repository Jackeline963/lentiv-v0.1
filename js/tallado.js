function initTallados(){
  listarIngresosTallado();
    $(".modal-header").on("mousedown", function(mousedownEvt) {
    let $draggable = $(this);
    let x = mousedownEvt.pageX - $draggable.offset().left,
        y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function(mousemoveEvt) {
    $draggable.closest(".modal-dialog").offset({
    "left": mousemoveEvt.pageX - x,
      "top": mousemoveEvt.pageY - y
    });
    });
    $("body").one("mouseup", function() {
      $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function() {
        $("body").off("mousemove.draggable");
    });
  });
}

function getCorrelativoIngresos(){
    $.ajax({
    url:"../ajax/tallados.php?op=get_correlativo_ingreso",
    method:"POST",
    cache:false,
    dataType:"json",
      success:function(data){
        console.log(data)    
        $("#n_ing_tallado").html(data.correlativo);             
      }
    })
}

document.getElementById("ingresos_t").addEventListener("click", function() {
  console.log("Correlativo")
  getCorrelativoIngresos();
})

$(document).on('click', '#ingresos_t', function(){ 
  items_tallado = [];
  show_items();
});

function alerts_tallado(icono, titulo){
    Swal.fire({
        position: 'top-center',
        icon: icono,
        title: titulo,
        showConfirmButton: true,
        timer: 2500
    });
}

var items_tallado = [];
function registrar_ingreso_tallado(){    
	let cod_orden_act = $("#reg_intreso_tallado").val();	
	$.ajax({
      url:"../ajax/ordenes.php?op=get_data_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
      if(data !="error"){
        let codigo = data.codigo; 
        let indice = items_tallado.findIndex((objeto, indice, items_tallado) =>{
        return objeto.n_orden == codigo;
        });

        if(indice>=0){
            var y = document.getElementById("error_sound"); 
            y.play();
            alerts_productos("error","Orden ya existe en la lista!!");
            input_focus_clear();
      	  }else{
        		var x = document.getElementById("success_sound"); 
            x.play();
          	let items_ingresos = {
        		n_orden : data.codigo,
        		paciente: data.paciente,
        		optica: data.optica
            }
            items_tallado.push(items_ingresos);
            show_items();       
            input_focus_clear();  
          }          
        }else{
            var z = document.getElementById("error_sound"); 
            z.play();
            alerts_productos("error","Orden No existe");
            input_focus_clear();
        }
    }
    });
}

function input_focus_clear(){
	$("#reg_intreso_tallado").val("");
	$('#ing_tallado').on('shown.bs.modal', function() {
    $('#reg_intreso_tallado').focus();
    });
    //

}

function show_items(){

  $("#items_orden_tallado_ingresos").html('');

  let filas = "";
  for(let i=0;i<items_tallado.length;i++){
  	filas = filas +    
    "<tr style='text-align:center' id='item_t"+i+"'>"+
    "<td>"+(i+1)+"</td>"+
    "<td>"+items_tallado[i].n_orden+"</td>"+
    "<td>"+items_tallado[i].paciente+"</td>"+
    "<td>"+items_tallado[i].optica+"</td>"+
    "<td>"+"<button type='button'  class='btn btn-sm bg-light' onClick='detOrdenes("+'"'+items_tallado[i].n_orden+'"'+")'><i class='fa fa-eye' aria-hidden='true' style='color:blue'></i></button>"+"</td>"+
    "<td>"+"<button type='button'  class='btn btn-sm bg-light' onClick='eliminarItemTallado("+i+")'><i class='fa fa-times-circle' aria-hidden='true' style='color:red'></i></button>"+"</td>"+
    "</tr>";
  }

  $("#items_orden_tallado_ingresos").html(filas);
}

function eliminarItemTallado(index) {
  $("#item_t" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  items_tallado.splice(position_element, 1);
  $('#reg_intreso_tallado').focus();
}

function registrarIngresoTallado(){
  let cant_items = items_tallado.length;
  if (cant_items<1) {
     alerts_productos("warning", "Lista de ingresos vacia");
     $('#reg_intreso_tallado').focus(); return false;
  }
  let id_usuario = $("#id_usuario").val();
  let correlativo_ing = $("#n_ing_tallado").html();
  $.ajax({
  url:"../ajax/tallados.php?op=registrar_ingreso_tallado",
  method: "POST",
  data: {'arrayItemsTallado':JSON.stringify(items_tallado),'id_usuario':id_usuario,'correlativo_ing':correlativo_ing},
  cache:  false,
  dataType: "json",
  success:function(data){
    if (data=="Register"){
      $("#ing_tallado").modal("hide");
      alerts_productos("success", "Ordenes ingresadas a tallado");
      $("#data_ingresos_tallado").DataTable().ajax.reload();
    }else{
      alerts_productos("error", "Orden de Ingresos ha sido registrada");
      $("#ing_tallado").modal("hide");
    }
;   
}
 });//Fin Ajax
}


function listarIngresosTallado(){
  tabla_ingresos = $('#data_ingresos_tallado').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [     
      'excelHtml5',
    ],

    "ajax":{
      url:"../ajax/tallados.php?op=listar_ingresostallado",
      type : "POST",
      dataType : "json",
      //data:{},           
      error: function(e){
      console.log(e.responseText);
    },           
    },

        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 25,//Por cada 10 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
          "language": { 
          "sProcessing":     "Procesando...",       
          "sLengthMenu":     "Mostrar _MENU_ registros",       
          "sZeroRecords":    "No se encontraron resultados",       
          "sEmptyTable":     "Ningún dato disponible en esta tabla",       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",       
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",    
          "sInfoPostFix":    "",       
          "sSearch":         "Buscar:",       
          "sUrl":            "",       
          "sInfoThousands":  ",",       
          "sLoadingRecords": "Cargando...",       
          "oPaginate": {       
              "sFirst":    "Primero",       
              "sLast":     "Último",       
              "sNext":     "Siguiente",       
              "sPrevious": "Anterior"       
          },
       
          "oAria": {       
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",       
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
       
          }

         }, //cerrando language

          //"scrollX": true

    });
}

initTallados()

