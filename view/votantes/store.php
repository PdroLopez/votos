<?php

$nombre = $_POST["nombre"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$correo = $_POST["correo"];
$region = (int) $_POST["region"];
$comuna = (int) $_POST["comuna"];
$candidato = (int) $_POST["candidato"];


   require_once("/xampp/htdocs/votos/controller/votanteController.php");
    $obj = new votanteController();
    $obj->guardar($nombre,$alias,$rut,$correo,$region,$comuna,$candidato);

?>