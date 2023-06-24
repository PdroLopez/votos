<?php 
class votanteController{
        private $model;
        public function __construct()
        {
            require_once("/xampp/htdocs/votos/model/votanteModel.php");
            $this->model = new votanteModel();
        }

        public function guardar($nombre,$alias,$rut,$correo,$region,$comuna,$candidato){
            $id = $this->model->insertar($nombre,$alias,$rut,$correo,$region,$comuna,$candidato);
            return ($id!=false) ?  : header("Location:index.php");
      
        }
        public function validarVoto($rut){
            require '/xampp/htdocs/votos/model/votanteModel.php';
            $obj = new votanteModel();
            $consulta = $obj->llamarRegion();
            echo json_encode($consulta);
        }
}


?>