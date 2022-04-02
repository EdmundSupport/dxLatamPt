<?php
require_once 'model/EntornosModel.php';

class EntornosController extends EntornosModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllEntornos($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getEntornoById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addEntorno($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteEntorno($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateEntorno($id, $this->cnn);
    }
}

?>