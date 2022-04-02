<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('controller/ProyectosController.php');

$method = strtolower ($_SERVER['REQUEST_METHOD']);

$proyectos_controller = new ProyectosController();
$peticion = json_decode(file_get_contents("php://input"),true);
if($_SERVER['REQUEST_METHOD']!=null && $_SERVER['REQUEST_METHOD'] !=""){
    switch ($method) {
        case 'get':
            
            if(isset($peticion['id'])){
                //get one row
                $id = $peticion['id'];
                $resulset = $proyectos_controller->getById($id);

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
                
            }else{ // get all row
                $resulset = $proyectos_controller->getAll();

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
            }

            break;
        case 'post':
            # code...
            $array_proyectos = array(
                            'nombre'   => ($peticion['nombre']),             
                            'sta'  => ($peticion['sta'] )
            );

            $result = $proyectos_controller->add($array_proyectos);
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
                $array_proyectos = array(
                    'nombre'   => ($peticion['nombre']),
                    'sta'   => ($peticion['sta']),
                    'id'  => $id
                );

                $result = $proyectos_controller->update($array_proyectos);
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
                $rs = $proyectos_controller->delete($id);
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