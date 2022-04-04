<?php
require_once 'model/UsuariosSoModel.php';

class UsuariosSoController extends UsuariosSoModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllUsuariosSo($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getUsuarioSoById($id, $this->cnn);
    }

    public function add($id){

        $this->cnn = $this->connect();
        return $result = $this->addUsuarioSo($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteUsuarioSo($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateUsuarioSo($id, $this->cnn);
    }
}

?>