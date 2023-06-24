<?php 




require '/xampp/htdocs/votos/model/votanteModel.php';
$obj = new votanteModel();
$region_id  = $_POST['region_id'];
$consulta = $obj->llamarComuna($region_id);
echo json_encode($consulta);



?>