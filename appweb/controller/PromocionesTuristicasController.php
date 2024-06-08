<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/appweb/config/global.php");

require_once(ROOT_DIR . "/model/PromocionesTuristicasModel.php");


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}
switch ($method) {
    case 'GET': //consulta

        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {

            if ($p_ope == 'filterId') {
                filterId($input);
            } elseif ($p_ope == 'filterSearch') {
                filterPaginateAll($input);
            } elseif ($p_ope ==  'filterall') {
                filterAll($input);
            }
        }

        break;
    case 'POST': //inserta
        insert($input);
        break;
    case 'PUT': //actualiza
        update($input);
        break;
    case 'DELETE': //elimina
       
        delete($input);
        break;
    default: //metodo NO soportado
        echo 'METODO NO SOPORTADO';
        break;
}
function  filterId($input)
{
    $tseg_modulo = new PromocionesTuristicasModel();
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $var = $tseg_modulo->findId($p_id);
    echo json_encode($var);
}
function  filterPaginateAll($input)
{
    $nro_record_page = 10;
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tseg_modulo = new PromocionesTuristicasModel();
    $var = $tseg_modulo->findpaginateall($filter, $p_limit, $p_offset);
    echo json_encode($var);
}

function  filterAll($input)
{
    $tseg_modulo = new PromocionesTuristicasModel();
    $var = $tseg_modulo->findall();
    echo json_encode($var);
}
function insert($input)
{
    $p_nombre_servicio = !empty($input['nombre_servicio']) ? $input['nombre_servicio'] : $_POST['nombre_servicio'];
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_POST['descripcion'];
    $p_numero_camaras = !empty($input['numero_camaras']) ? $input['numero_camaras'] : $_POST['numero_camaras'];
    $p_tipo_camara = !empty($input['tipo_camara']) ? $input['tipo_camara'] : $_POST['tipo_camara'];
    $p_garantia = !empty($input['garantia']) ? $input['garantia'] : $_POST['garantia'];
    $p_tiempo_instalacion = !empty($input['tiempo_instalacion']) ? $input['tiempo_instalacion'] : $_POST['tiempo_instalacion'];
    $p_monitoreo_remoto = !empty($input['monitoreo_remoto']) ? $input['monitoreo_remoto'] : $_POST['monitoreo_remoto'];
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_POST['precio'];
    


    $p_usu_cre = 'Admin';//$_SESSION['cod_usu'];
     $tseg_modulo = new PromocionesTuristicasModel();
    $var =  $tseg_modulo->insert($p_nombre_servicio, $p_descripcion, $p_numero_camaras, $p_tipo_camara, $p_garantia, $p_tiempo_instalacion, $p_monitoreo_remoto, $p_precio);
    echo json_encode($var);
}
function update($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    $p_nombre_servicio = !empty($input['nombre_servicio']) ? $input['nombre_servicio'] : $_POST['nombre_servicio'];
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_POST['descripcion'];
    $p_numero_camaras = !empty($input['numero_camaras']) ? $input['numero_camaras'] : $_POST['numero_camaras'];
    $p_tipo_camara = !empty($input['tipo_camara']) ? $input['tipo_camara'] : $_POST['tipo_camara'];
    $p_garantia = !empty($input['garantia']) ? $input['garantia'] : $_POST['garantia'];
    $p_tiempo_instalacion = !empty($input['tiempo_instalacion']) ? $input['tiempo_instalacion'] : $_POST['tiempo_instalacion'];
    $p_monitoreo_remoto = !empty($input['monitoreo_remoto']) ? $input['monitoreo_remoto'] : $_POST['monitoreo_remoto'];
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_POST['precio'];
    
    
    $tseg_modulo = new PromocionesTuristicasModel();
    $var = $tseg_modulo->update($p_id,$p_nombre_servicio, $p_descripcion, $p_numero_camaras, $p_tipo_camara, $p_garantia, $p_tiempo_instalacion, $p_monitoreo_remoto, $p_precio);

    echo json_encode($var);
}
function delete($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    $tseg_modulo = new PromocionesTuristicasModel();
    $var = $tseg_modulo->delete($p_id);

    echo json_encode($var);
}
