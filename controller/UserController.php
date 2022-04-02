<?php
require_once 'model/UserModel.php';

class UserController extends UserModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllUser($this->cnn);
    }

    public function getById($id){
        $this->cnn = $this->connect();
        return $result = $this->getUserById($id, $this->cnn);
    }

    public function add($id){
        $this->cnn = $this->connect();
        return $result = $this->addUser($id, $this->cnn);
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteUser($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateUser($id, $this->cnn);
    }
}

?>