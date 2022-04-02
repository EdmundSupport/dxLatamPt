<?php
require_once 'model/RegionesModel.php';

class RegionesController extends RegionesModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllRegiones($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getRegionById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addRegion($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteRegion($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateRegion($id, $this->cnn);
    }
}

?>