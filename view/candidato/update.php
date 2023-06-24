<?php
    require_once("/xampp/htdocs/votos/controller/candidatoController.php");
    $obj = new candidatoController();
    $obj->update($_POST['id'],$_POST['nombre']);

?>