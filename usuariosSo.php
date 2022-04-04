<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('controller/UsuariosSoController.php');
require_once('controller/UsuariosController.php');
require_once('controller/RegionesController.php');
require_once('controller/ProyectosController.php');
require_once('controller/ClientesController.php');
require_once('controller/SistemasOperativosController.php');
require_once('controller/EntornosController.php');

$method = strtolower ($_SERVER['REQUEST_METHOD']);

$usuarios_so_controller = new UsuariosSoController();
$usuarios_controller = new UsuariosController();
$regiones_controller = new RegionesController();
$proyectos_controller = new ProyectosController();
$clientes_controller = new ClientesController();
$sistemas_operativos_controller= new SistemasOperativosController();
$entornos_controller = new EntornosController();

$peticion = json_decode(file_get_contents("php://input"),true);
if($_SERVER['REQUEST_METHOD']!=null && $_SERVER['REQUEST_METHOD'] !=""){
    switch ($method) {
        case 'get':
            
            if(isset($_GET['id'])){
                //get one row
                $id = $_GET['id'];
                $resulset = $usuarios_so_controller->getById($id);

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
                
            }else{ // get all row
                $resulset = $usuarios_so_controller->getAll();

                if($resulset!=false){
                    echo json_encode($resulset);
                }else{
                    mensaje('No existen registro...');
                }
            }

            break;
        case 'post':
            # code...

            /**
             * Verificamos la integridad de los datos
             */
            if(!isset($peticion['proyectos_id'])) error('No se encontro el proyecto.');
            $result = $proyectos_controller->getById($peticion['proyectos_id']);
            if(!($result==true)){
                error('No se encontro el proyecto.');
            }

            if(!isset($peticion['clientes_id'])) error('No se encontro el proyecto.');
            $result = $clientes_controller->getById($peticion['clientes_id']);
            if(!($result==true)){
                error('No se encontro el cliente.');
            }

            if(!isset($peticion['so_id'])) error('No se encontro el proyecto.');
            $result = $sistemas_operativos_controller->getById($peticion['so_id']);
            if(!($result==true)){
                error('No se encontro el sistema operativo.');
            }

            if(!isset($peticion['entornos_id'])) error('No se encontro el proyecto.');
            $result = $entornos_controller->getById($peticion['entornos_id']);
            if(!($result==true)){
                error('No se encontro el entorno.');
            }

            if(!isset($peticion['regiones_id'])) error('No se encontro el proyecto.');
            $result = $regiones_controller->getById($peticion['regiones_id']);
            if(!($result==true)){
                error('No se encontro la region.');
            }

            $array_usuarios_so = array(
                            'nombre'   => ($peticion['nombre']),             
                            'proyectos_id'   => ($peticion['proyectos_id']),             
                            'costo_usd_mes'   => ($peticion['costo_usd_mes']),             
                            'clientes_id'   => ($peticion['clientes_id']),             
                            'so_id'   => ($peticion['so_id']),             
                            'url_key'   => ($peticion['url_key']),             
                            'entornos_id'   => ($peticion['entornos_id']),             
                            'ip'   => ($peticion['ip']),             
                            'url_img_proyecto'   => ($peticion['url_img_proyecto']),             
                            'estado'   => ($peticion['estado']),             
                            'ram'   => ($peticion['ram']),             
                            'ssd'   => ($peticion['ssd']),             
                            'core'   => ($peticion['core']),             
                            'puertos'   => ($peticion['puertos']),             
                            'regiones_id'   => ($peticion['regiones_id'])
            );

            $result = $usuarios_so_controller->add($array_usuarios_so);
            if($result==true){
                mensaje('Registro guardado exitosamente');
            }else{
                error('Error al intentar guardar registro');
            }
            
            break;
        case 'put':
            # code...

            if (isset($peticion['id'])) {
                /**
                 * Verificamos la integridad de los datos
                 */
                if(!isset($peticion['proyectos_id'])) error('No se encontro el proyecto.');
                $result = $proyectos_controller->getById($peticion['proyectos_id']);
                if(!($result==true)){
                    error('No se encontro el proyecto.');
                }

                if(!isset($peticion['clientes_id'])) error('No se encontro el proyecto.');
                $result = $clientes_controller->getById($peticion['clientes_id']);
                if(!($result==true)){
                    error('No se encontro el cliente.');
                }

                $result = $sistemas_operativos_controller->getById($peticion['so_id']);
                if(!($result==true)){
                    error('No se encontro el sistema operativo.');
                }

                $result = $entornos_controller->getById($peticion['entornos_id']);
                if(!($result==true)){
                    error('No se encontro el entorno.');
                }

                $result = $regiones_controller->getById($peticion['regiones_id']);
                if(!($result==true)){
                    error('No se encontro la region.');
                }

                $id = $peticion['id'];
                $array_usuarios_so = array(
                    'nombre'   => ($peticion['nombre']),             
                    'proyectos_id'   => ($peticion['proyectos_id']),             
                    'costo_usd_mes'   => ($peticion['costo_usd_mes']),             
                    'clientes_id'   => ($peticion['clientes_id']),             
                    'so_id'   => ($peticion['so_id']),             
                    'url_key'   => ($peticion['url_key']),             
                    'entornos_id'   => ($peticion['entornos_id']),             
                    'ip'   => ($peticion['ip']),             
                    'url_img_proyecto'   => ($peticion['url_img_proyecto']),             
                    'estado'   => ($peticion['estado']),             
                    'ram'   => ($peticion['ram']),             
                    'ssd'   => ($peticion['ssd']),             
                    'core'   => ($peticion['core']),             
                    'puertos'   => ($peticion['puertos']),             
                    'regiones_id'   => ($peticion['regiones_id']),
                    'id'  => $id
                );

                $result = $usuarios_so_controller->update($array_usuarios_so);
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
                $rs = $usuarios_so_controller->delete($id);
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
    die();
}

function mensaje($mensaje){
    echo json_encode($mensaje);
}

?>