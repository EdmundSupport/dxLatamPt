<?php 
require_once 'config/Conexion.php';

class RegionesModel extends Conexion {

    private $id;
    private $nombre;
    private $lat;
    private $lng;
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
     * Get the value of lat
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return  self
     */ 
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of lng
     */ 
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     *
     * @return  self
     */ 
    public function setLng($lng)
    {
        $this->lng = $lng;

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

    public function getAllRegiones($cnn){
        try {
            $sql = 'SELECT * FROM regiones ORDER BY id DESC';
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

    public function getRegionById($id,$cnn){
        try {
            $sql = 'SELECT * FROM regiones where id =:id order by id desc';
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

    public function addRegion($regiones,$cnn){
        
        try {
            $sql = 'INSERT INTO regiones (nombre, lat, lng, sta)
 				    VALUES               (:nombre, :lat, :lng, :sta)';
            $stmt = $cnn->prepare($sql);
            $rs = $stmt->execute(array(
                ":nombre"   => $regiones['nombre'],
                ":lat"   => $regiones['lat'],
                ":lng" => $regiones['lng'],
                ":sta"  => $regiones['sta']
            ));

            return $rs;
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function deleteRegion($id,$cnn){
        try {
            $sql = 'DELETE FROM regiones WHERE id =:id LIMIT 1';
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

    public function updateRegion($regiones,$cnn){
        try {
            $data = [
                'id'    => $regiones['id'],
                'nombre'    => $regiones['nombre'],
                'lat'  => $regiones['lat'],
                'lng'   => $regiones['lng'],
                'sta'   => $regiones['sta']
            ];
            $sql = "UPDATE regiones SET nombre=:nombre, lat=:lat, lng=:lng, sta=:sta WHERE id=:id LIMIT 1";
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
