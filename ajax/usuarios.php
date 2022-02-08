<?php
require_once("../config/conexion.php");
require_once("../modelos/Usuario.php");

$usuarios = new User();

switch ($_GET["op"]){//inicio switch

	case 'get_codigo_usuario':   //generando codigo usuario
	$datos= $usuarios->get_codigo_usuario();

	if(is_array($datos)==true and count($datos)>0){
		foreach($datos as $row){                  
			$codigo=$row["codigo_emp"];
			$cod=(substr($codigo,3,11))+1;
			$output["correlativo"]="UL"."-".$cod;
		}             
	}else{
		$output["correlativo"]="UL"."-1";
	}

	echo json_encode($output);

	break;

	case 'guardar_usuario': //Registrando paciente
	$datos=$usuarios->valida_existencia_usuarios($_POST["telefono"],$_POST["codigo"]);
	if(is_array($datos)==true and count($datos)==0){
		$usuarios->guardar_usuario($_POST["nombre"],$_POST["telefono"],$_POST["correo"],$_POST["dui"],$_POST["direccion"],$_POST["usuario"],$_POST["pass"],$_POST["codigo"],$_POST["nick"],$_POST["nit"],$_POST["isss"],$_POST["afp"],$_POST["cuenta"],$_POST["fecha_ingreso"],$_POST["estado"]);
		$messages[]="ok";
	}else{
		$errors[]="error";
	}
	if (isset($messages)){
		?>
		<?php
		foreach ($messages as $message) {
			echo json_encode($message);
		}
		?>
		<?php
	}
    //mensaje error
	if (isset($errors)){

		?>
		<?php
		foreach ($errors as $error) {
			echo json_encode($error);
		}
		?>
		<?php
	}
//fin mensaje error
	break;

	case 'listar_usuarios_lenti':  //Listar usuarios de lenti
	$datos=$usuarios->get_usuarios();

	$data= Array();

	foreach($datos as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["id_usuario"];
		$sub_array[] = $row["codigo_emp"];
		$sub_array[] = $row["nombre"];
		$sub_array[] = $row["direccion"];
		$sub_array[] = $row["correo"];
		$sub_array[] = $row["fecha_ingreso"];
		$sub_array[] = '<button type="button" id="'.$row["id_usuario"].'" class="btn btn-edit btn-sm editar_usuario  bg-light" style="text-align:center" onClick="ver_datos_usuario('.$row["id_usuario"].',\''.$row["codigo_emp"].'\');" data-toggle="modal" data-target="#nuevo_usuario" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>

		<button type="button"  class="btn btn-sm bg-light" onClick="permisos_usuario('.$row["id_usuario"].')"><i class="fa fa-key" aria-hidden="true"></i></i></button>';

		$data[] = $sub_array;
	}

	$results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
	echo json_encode($results);
	break;





}//fin swtch


