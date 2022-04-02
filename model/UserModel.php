<?php 
require_once 'config/Conexion.php';

class UserModel extends Conexion {

    private $nombre;
    private $apellido;
    private $usuario;

    /**
     * Get the value of nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */ 
    public function setApellido($apellido){
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario(){
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario){
        $this->usuario = $usuario;

        return $this;
    }

    public function getAllUser($cnn){
        try {
            $sql = 'SELECT * FROM user order by id desc';
            $stmt = $cnn->prepare($sql);
            $stmt->execute();

            return $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }

    }

    public function getUserById($id,$cnn){
        try {
            $sql = 'SELECT * FROM user where id =:id order by id desc';
            $stmt = $cnn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $result = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }

    }

    public function addUser($user,$cnn){
        
        try {
            $sql = 'INSERT INTO user(nombre, apellido, usuario)
 				    VALUES             (:nombre,:apellido,:usuario)';
            $stmt = $cnn->prepare($sql);
            $rs = $stmt->execute(array(
                ":nombre"   => $user['nombre'],
                ":apellido" => $user['apellido'],
                ":usuario"  => $user['usuario']
            ));

            return $rs;
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function deleteUser($id,$cnn){
        try {
            $sql = 'DELETE FROM user WHERE id =:id';
            $stmt = $cnn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if (!$stmt->rowCount()) {
                return 0;
            }else{
                return 1;
            }
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }

    }

    public function updateUser($user,$cnn){
        try {
            $data = [
                'nombre'    => $user['nombre'],
                'apellido'  => $user['apellido'],
                'usuario'   => $user['usuario']
            ];
            $sql = "UPDATE user SET nombre=:nombre, apellido=:apellido,  usuario=:usuario  WHERE usuario=:usuario";
            $stmt = $cnn->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0) {
                return 0;
            }
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }

    }
}

?>
