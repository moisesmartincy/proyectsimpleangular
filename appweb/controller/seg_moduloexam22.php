<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/appweb/config/global.php");
require_once(ROOT_DIR . "/model/seg_modulexam2.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
    exit();
}

switch ($method) {
    case 'GET': // Consulta
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
    case 'POST': // Inserta
        insert($input);
        break;
    case 'PUT': // Actualiza
        update($input);
        break;
    case 'DELETE': // Elimina
        delete($input);
        break;
    default: // Método NO soportado
        echo json_encode(array("error" => "MÉTODO NO SOPORTADO"));
        break;
}

function filterId($input)
{
    $tseg_modulo = new seg_modulexam2();
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $var = $tseg_modulo->findId($p_id);
    echo json_encode($var);
}

function filterPaginateAll($input)
{
    $nro_record_page = 10;
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $p_limit = 10;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tseg_modulo = new seg_modulexam2();
    $var = $tseg_modulo->findpaginateall($filter, $p_limit, $p_offset);
    echo json_encode($var);
}

function filterAll($input)
{
    $tseg_modulo = new seg_modulexam2();
    $var = $tseg_modulo->findall();
    echo json_encode($var);
}

function insert($input)
{
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_GET['nombre'];
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_GET['descripcion'];
    $p_destino = !empty($input['destino']) ? $input['destino'] : $_GET['destino'];
    $p_duracion = !empty($input['duracion']) ? $input['duracion'] : $_GET['duracion'];
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_GET['precio'];
    $p_cupo = !empty($input['cupo']) ? $input['cupo'] : $_GET['cupo'];
    $p_contacto = !empty($input['contacto']) ? $input['contacto'] : $_GET['contacto'];
    
    $tseg_modulo = new seg_modulexam2();
    $var = $tseg_modulo->insert($p_nombre, $p_descripcion, $p_destino, $p_duracion, $p_precio, $p_cupo, $p_contacto);
    echo json_encode($var);
}

function update($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_GET['nombre'];
    $p_descripcion = !empty($input['descripcion']) ? $input['descripcion'] : $_GET['descripcion'];
    $p_destino = !empty($input['destino']) ? $input['destino'] : $_GET['destino'];
    $p_duracion = !empty($input['duracion']) ? $input['duracion'] : $_GET['duracion'];
    $p_precio = !empty($input['precio']) ? $input['precio'] : $_GET['precio'];
    $p_cupo = !empty($input['cupo']) ? $input['cupo'] : $_GET['cupo'];
    $p_contacto = !empty($input['contacto']) ? $input['contacto'] : $_GET['contacto'];
    
    $tseg_modulo = new seg_modulexam2();
    $var = $tseg_modulo->update($p_id, $p_nombre, $p_descripcion, $p_destino, $p_duracion, $p_precio, $p_cupo, $p_contacto);
    echo json_encode($var);
}

function delete($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $tseg_modulo = new seg_modulexam2();
    $var = $tseg_modulo->delete($p_id);
    echo json_encode($var);
}
?>
