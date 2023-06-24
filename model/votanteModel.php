<?php

    class votanteModel{
        private $PDO;
        public function __construct()
        {
            require_once("/xampp/htdocs/votos/config/db.php");
            $con = new db();
            $this->PDO = $con->conexion();
        }

        public function llamarRegion(){
            $stament = $this->PDO->prepare("SELECT * FROM region_cl");
            return ($stament->execute()) ? $stament->fetchAll() : false;
        }
        public function llamarCandidato(){
            $stament = $this->PDO->prepare("SELECT * FROM candidato");
            return ($stament->execute()) ? $stament->fetchAll() : false;
        }
        public function existeVoto($rut){
            $stament = $this->PDO->prepare("select * from votante where rut =:rut");
            $stament->bindParam(":rut",$rut);
            return ($stament->execute()) ? $stament->fetch() : false;
        }
        public function llamarComuna($region_id){
            $stament = $this->PDO->prepare("SELECT id_pr,str_descripcion FROM provincia_cl where id_re = :region_id ");
            $stament->bindParam(":region_id",$region_id);
            return ($stament->execute()) ? $stament->fetchAll() : false;
        }
        public function insertar($nombre,$alias,$rut,$correo,$region,$comuna,$candidato){
            $stament = $this->PDO->prepare("INSERT INTO votante VALUES(null,:nombre,:alias,:rut,:correo,:region_id,:comuna_id,:candidato_id)");
            $stament->bindParam(":nombre",$nombre);
            $stament->bindParam(":alias",$alias);
            $stament->bindParam(":rut",$rut);
            $stament->bindParam(":correo",$correo);
            $stament->bindParam(":region_id",$region);
            $stament->bindParam(":comuna_id",$comuna);
            $stament->bindParam(":candidato_id",$candidato);

            return ($stament->execute()) ? $this->PDO->lastInsertId() : false ;
        }

        
    }


?>