<?php 
require '/xampp/htdocs/votos/model/votanteModel.php';
$obj = new votanteModel();
$rut  = $_POST['rut'];
$consulta = $obj->existeVoto($rut);

echo json_encode($consulta);
  // require_once("/xampp/htdocs/votos/controller/candidatoController.php");
  // $obj = new candidatoController();
  // $op =  $obj->phpRule_ValidarRut($_POST['rut']);
  // if ($op == 1) { //1= El rut es correcto
  //   # code...
  //   $op2 =  $obj->validarVoto($_POST['rut']);
  //   if ($op2 == 1) { //1= El rut no esta ingresaso en la base de datos


      
  //     // require_once("/xampp/htdocs/votos/controller/candidatoController.php");
  //     // $obj = new candidatoController();
  //     // $obj->guardar($_POST['nombre']);
  //     # code...
  //   }

  //   $message = 'El rut es correcto y se Guardó correctamente';

  //   echo "<SCRIPT> 
  //       alert('$message')
  //       window.location.replace('/');
  //   </SCRIPT>";
  // }
  // else{
  //   $message = 'El rut es incorrecto..';

  //   echo "<SCRIPT> 
  //       alert('$message')
  //       window.location.replace('/');
  //   </SCRIPT>";
  // }

?>