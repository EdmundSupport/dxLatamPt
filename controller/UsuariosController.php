<?php
require_once 'model/UsuariosModel.php';

class UsuariosController extends UsuariosModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllUsuarios($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getUsuarioById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addUsuario($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteUsuario($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateUsuario($id, $this->cnn);
    }
}

?>