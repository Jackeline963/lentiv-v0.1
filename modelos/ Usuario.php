<?php 
require_once("../config/conexion.php");

class User extends Conectar {//inicio de la clase

  public function get_codigo_usuario(){
    $conectar= parent::conexion();
    $sql= "select codigo_emp from usuarios order by codigo_emp DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  } 

    //validar existencia de usuario
  public function valida_existencia_usuarios($telefono,$codigo){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select * from usuarios WHERE telefono=? and codigo_emp=?;";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $telefono);
    $sql->bindValue(2, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }

  ////GUARDAR OPTICA
  public function guardar_usuario($nombre,$telefono,$correo,$dui,$direccion,$usuario,$pass,$codigo,$nick,$nit,$isss,$afp,$cuenta,$fecha_ingreso,$estado){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="insert into usuarios values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $nombre);
    $sql->bindValue(2, $telefono);
    $sql->bindValue(3, $correo);
    $sql->bindValue(4, $dui);
    $sql->bindValue(5, $direccion);
    $sql->bindValue(6, $usuario);
    $sql->bindValue(7, $pass);
    $sql->bindValue(8, $codigo);
    $sql->bindValue(9, $nick);
    $sql->bindValue(10, $nit);
    $sql->bindValue(11, $isss);
    $sql->bindValue(12, $afp);
    $sql->bindValue(13, $cuenta);
    $sql->bindValue(14, $fecha_ingreso);
    $sql->bindValue(15, $estado);
    $sql->execute();
  }

      ///LISTAR usuario lenti
  public function get_usuarios(){
    $conectar= parent::conexion();
    $sql= "select * from usuarios;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }


}//FIN class