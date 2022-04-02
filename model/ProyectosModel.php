<?php 
require_once 'config/Conexion.php';

class ProyectosModel extends Conexion {

    private $id;
    private $nombre;
    private $sta;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of sta
     */ 
    public function getSta()
    {
        return $this->sta;
    }

    /**
     * Set the value of sta
     *
     * @return  self
     */ 
    public function setSta($sta)
    {
        $this->sta = $sta;

        return $this;
    }

    public function getAllProyectos($cnn){
        try {
            $sql = 'SELECT * FROM proyectos ORDER BY id DESC';
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

    public function getClienteById($id,$cnn){
        try {
            $sql = 'SELECT * FROM proyectos where id =:id order by id desc';
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

    public function addCliente($proyectos,$cnn){
        
        try {
            $sql = 'INSERT INTO proyectos (nombre, sta)
 				    VALUES               (:nombre, :sta)';
            $stmt = $cnn->prepare($sql);
            $rs = $stmt->execute(array(
                ":nombre"   => $proyectos['nombre'],
                ":sta"  => $proyectos['sta']
            ));

            return $rs;
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function deleteCliente($id,$cnn){
        try {
            $sql = 'DELETE FROM proyectos WHERE id =:id LIMIT 1';
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

    public function updateCliente($proyectos,$cnn){
        try {
            $data = [
                'id'    => $proyectos['id'],
                'nombre'    => $proyectos['nombre'],
                'sta'   => $proyectos['sta']
            ];
            $sql = "UPDATE proyectos SET nombre=:nombre, sta=:sta WHERE id=:id LIMIT 1";
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
