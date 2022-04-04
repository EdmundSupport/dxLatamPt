<?php 
require_once 'config/Conexion.php';

class UsuariosModel extends Conexion {

    private $id;
    private $usuario;
    private $correo;
    private $telefono;
    private $roles_id;
    private $sta;
    private $enUso;

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of roles_id
     */ 
    public function getRoles_id()
    {
        return $this->roles_id;
    }

    /**
     * Set the value of roles_id
     *
     * @return  self
     */ 
    public function setRoles_id($roles_id)
    {
        $this->roles_id = $roles_id;

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

    /**
     * Get the value of enUso
     */ 
    public function getEnUso()
    {
        return $this->enUso;
    }

    /**
     * Set the value of enUso
     *
     * @return  self
     */ 
    public function setEnUso($enUso)
    {
        $this->enUso = $enUso;

        return $this;
    }

    public function getAllUsuarios($cnn){
        try {
            $sql = 'SELECT * FROM usuarios ORDER BY id DESC';
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

    public function getUsuarioById($id,$cnn){
        try {
            $sql = 'SELECT * FROM usuarios where id =:id order by id desc';
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

    public function addUsuario($usuarios,$cnn){
        
        try {
            $sql = 'INSERT INTO usuarios (usuario, password, correo, telefono, roles_id, sta, enUso)
 				    VALUES               (:usuario, :password, :correo, :telefono, :roles_id, :sta, :enUso)';
            $stmt = $cnn->prepare($sql);
            $rs = $stmt->execute(array(
                ":usuario"   => $usuarios['usuario'],
                ":password"   => $usuarios['password'],
                ":correo" => $usuarios['correo'],
                ":telefono"  => $usuarios['telefono'],
                ":roles_id"  => $usuarios['roles_id'],
                ":sta"  => $usuarios['sta'],
                ":enUso"  => $usuarios['enUso']
            ));

            return $rs;
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function deleteUsuario($id,$cnn){
        try {
            $sql = 'DELETE FROM usuarios WHERE id =:id LIMIT 1';
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

    public function updateUsuario($usuarios,$cnn){
        try {
            $data = [
                'id'    => $usuarios['id'],
                'usuario'    => $usuarios['usuario'],
                'password'  => $usuarios['password'],
                'correo'   => $usuarios['correo'],
                'telefono'   => $usuarios['telefono'],
                'roles_id'   => $usuarios['roles_id'],
                'sta'   => $usuarios['sta'],
                'enUso'   => $usuarios['enUso']
            ];
            $sql = "UPDATE usuarios SET usuario=:usuario, password=:password,  correo=:correo,  telefono=:telefono,  roles_id=:roles_id,  sta=:sta,  enUso=:enUso  WHERE id=:id LIMIT 1";
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

    public function verificarPermiso($usuarios,$cnn){
        try {
            $data = [
                'usuarios_id'    => $usuarios['usuarios_id'],
                'modulos_id'    => $usuarios['modulos_id'],
                'permisos_id'  => $usuarios['permisos_id']
            ];

            $sql = "SELECT b.id, c.id, d.id FROM roles_permisos a 
            LEFT JOIN roles b ON b.id = a.roles_id
            LEFT JOIN modulos c ON c.id = a.modulos_id
            LEFT JOIN permisos d ON d.id = a.permisos_id
            WHERE b.sta = 1 AND c.sta = 1 AND d.sta = 1
            AND a.roles_id = :roles_id AND a.modulos_id = :modulos_id AND permisos_id = :permisos_id;";
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
