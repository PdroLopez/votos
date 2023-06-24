<?php
    require_once("/xampp/htdocs/votos/controller/candidatoController.php");
    $obj = new candidatoController();
    $obj->guardar($_POST['nombre']);
?>