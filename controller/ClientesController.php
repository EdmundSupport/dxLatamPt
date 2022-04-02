<?php
require_once 'model/ClientesModel.php';

class ClientesController extends ClientesModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllClientes($this->cnn);
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