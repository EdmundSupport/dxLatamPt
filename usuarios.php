<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('controller/UsuariosController.php');

$method = strtolower ($_SERVER['REQUEST_METHOD']);

header('Access-Control-Allow-Origin: *');

$usuarios_controller = new UsuariosController();
$peticion = json_decode(file_get_contents("php://input"),true);
if($_SERVER['REQUEST_METHOD']!=null && $_SERVER['REQUEST_METHOD'] !=""){
    switch ($method) {
        case 'get':
            
            if(isset($_GET['id'])){
                //get one row
                $id = $_GET['id'];
                $resulset = $usuarios_controller->getById($id);

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
                
            }else{ // get all row
                $resulset = $usuarios_controller->getAll();

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
            }

            break;
        case 'post':
            # code...
            $array_usuarios = array(
                            'usuario'   => ($peticion['usuario']),
                            'password' => ($peticion['password']),
                            'correo'  => ($peticion['correo'] ),              
                            'telefono'  => ($peticion['telefono'] ),    
                            'roles_id'  => ($peticion['roles_id'] ),    
                            'sta'  => ($peticion['sta'] ),    
                            'enUso'  => ($peticion['enUso'] ) 
            );

            $result = $usuarios_controller->add($array_usuarios);
            if($result==true){
                mensaje('Registro guardado exitosamente');
            }else{
                error('Error al intentar guardar registro');
            }
            
            break;
        case 'put':
            # code...

            if (isset($peticion['id'])) {
                //get one row
                $id = $peticion['id'];
                $array_usuarios = array(
                    'usuario'   => ($peticion['usuario']),
                    'password' => ($peticion['password']),
                    'correo'  => ($peticion['correo'] ),              
                    'telefono'  => ($peticion['telefono'] ),    
                    'roles_id'  => ($peticion['roles_id'] ),    
                    'sta'  => ($peticion['sta'] ),    
                    'enUso'  => ($peticion['enUso'] ),
                    'id'  => $id
                );

                $result = $usuarios_controller->update($array_usuarios);
                var_dump($result);
                if ($result == 0) {
                    mensaje('Registro actualizado exitosamente');
                } else {
                    error('Error al intentar actualizar registro');
                }
            }            
            
            break;
        case 'delete':
            # code...
            if (isset($peticion['id'])) {
                $id = $peticion['id'];
                $rs = $usuarios_controller->delete($id);
                if($rs == 1)
                mensaje('Registro borrado con exito.');

            }else{
                error('Error al borrar, falta ID...');
            }
            break;

        default:
            # code...
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET, POST, PUT, DELETE');
            error('Method not exist...' . $method);
            break;
    }    

}else{
    error('Error al llamar a la API');
}



function error($mensaje){
    echo json_encode($mensaje);
}

function mensaje($mensaje){
    echo json_encode($mensaje);
}

?>