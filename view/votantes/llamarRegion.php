<?php 
       require '/xampp/htdocs/votos/model/votanteModel.php';
       $obj = new votanteModel();
       $consulta = $obj->llamarRegion();
       echo json_encode($consulta);

?>