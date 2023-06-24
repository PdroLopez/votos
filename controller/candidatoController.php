<?php
    class candidatoController{
        private $model;
        public function __construct()
        {
            require_once("/xampp/htdocs/votos/model/candidatoModel.php");
            $this->model = new candidatoModel();
        }
        public function guardar($nombre){
            $id = $this->model->insertar($nombre);
            return ($id!=false) ? header("Location:show.php?id=".$id) : header("Location:create.php");
        }
        public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:index.php");
        }
        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
        }
        public function update($id, $nombre){
            return ($this->model->update($id,$nombre) != false) ? header("Location:show.php?id=".$id) : header("Location:index.php");
        }
        public function delete($id){
            return ($this->model->delete($id)) ? header("Location:index.php") : header("Location:show.php?id=".$id) ;
        }

       

        public function phpRule_ValidarRut($rut) {

            // Verifica que no esté vacio y que el string sea de tamaño mayor a 3 carácteres(1-9)        
            if ((empty($rut)) || strlen($rut) < 3) {
                return array('error' => true, 'msj' => 'RUT vacío o con menos de 3 caracteres.');
            }
    
            // Quitar los últimos 2 valores (el guión y el dígito verificador) y luego verificar que sólo sea
            // numérico
            $parteNumerica = str_replace(substr($rut, -2, 2), '', $rut);
    
            if (!preg_match("/^[0-9]*$/", $parteNumerica)) {
                return array('error' => true, 'msj' => 'La parte numérica del RUT sólo debe contener números.');
            }
    
            $guionYVerificador = substr($rut, -2, 2);
            // Verifica que el guion y dígito verificador tengan un largo de 2.
            if (strlen($guionYVerificador) != 2) {
                return array('error' => true, 'msj' => 'Error en el largo del dígito verificador.');
            }
    
            // obliga a que el dígito verificador tenga la forma -[0-9] o -[kK]
            if (!preg_match('/(^[-]{1}+[0-9kK]).{0}$/', $guionYVerificador)) {
                return array('error' => true, 'msj' => 'El dígito verificador no cuenta con el patrón requerido');
            }
    
            // Valida que sólo sean números, excepto el último dígito que pueda ser k
            if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
                return array('error' => true, 'msj' => 'Error al digitar el RUT');
            }
    
            $rutV = preg_replace('/[\.\-]/i', '', $rut);
            $dv = substr($rutV, -1);
            $numero = substr($rutV, 0, strlen($rutV) - 1);
            $i = 2;
            $suma = 0;
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i == 8) {
                    $i = 2;
                }
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);
            if ($dvr == 11) {
                $dvr = 0;
            }
            if ($dvr == 10) {
                $dvr = 'K';
            }
            if ($dvr == strtoupper($dv)) {
                return  1; //El rut es correcto
            } else {
                return  2; //El rut esta incorrecto
            }
        }

     
    }

?>