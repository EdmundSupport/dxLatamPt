<?php
require_once 'model/ProyectosModel.php';

class ProyectosController extends ProyectosModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllProyectos($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getClienteById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addCliente($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteCliente($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateCliente($id, $this->cnn);
    }
}

?>