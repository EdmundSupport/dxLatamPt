<?php
require_once 'model/SistemasOperativosModel.php';

class SistemasOperativosController extends SistemasOperativosModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllSistemasOperativos($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getSistemaOperativoById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addSistemaOperativo($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteSistemaOperativo($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateSistemaOperativo($id, $this->cnn);
    }
}

?>