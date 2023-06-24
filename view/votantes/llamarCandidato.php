<?php
  require '/xampp/htdocs/votos/model/votanteModel.php';
  $obj = new votanteModel();
  $consulta = $obj->llamarCandidato();
  echo json_encode($consulta);
?>