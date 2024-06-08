<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/config/global.php");
require_once(ROOT_DIR . "/model/InscripcionesModel.php");

$method = $_SERVER['REQUEST_METHOD'];
$input  = json_decode(file_get_contents('php://input'), true);
try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}
switch ($method) {
    case 'GET':
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {
            if ($p_ope == 'filterall') {
                filterAll($input);
            } else if ($p_ope == 'filterId') {
                filterId($input);
            } else if ($p_ope == 'filterSearch') {
                filterPaginateAll($input);
            }
        }
        break;
    case 'POST':
        insert($input);
        break;
    case 'PUT':
        update($input);
        break;
    case 'DELETE':
        delete($input);
        break;
    default:
        echo 'NO SOPORTADO';
        break;
}
function filterAll($input)
{
    $objIns = new InscripcionesModel();
    $var = $objIns->findall();
    echo json_encode($var);
}
function filterId($input)
{
    $p_id = !empty($input['id']) ? $input['id'] : $_GET['id'];
    $objIns = new InscripcionesModel();
    $var = $objIns->findid($p_id);
    echo json_encode($var);
}
function filterPaginateAll($input)
{
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $filter = !empty($input['filter']) ? $input['filter'] : $_GET['filter'];
    $nro_record_page = 10;
    $p_limit = 10;
    $p_offset = 0;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $objIns = new InscripcionesModel();
    $var = $objIns->findpaginateall($filter, $p_limit, $p_offset);
    echo json_encode($var);
}
function insert($input){
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];
    $p_apellido = !empty($input['apellido']) ? $input['apellido'] : $_POST['apellido'];
    $p_curso = !empty($input['curso']) ? $input['curso'] : $_POST['curso'];
    $p_nivel = !empty($input['nivel']) ? $input['nivel'] : $_POST['nivel'];
    $objIns = new InscripcionesModel();
    $var = $objIns->insert($p_nombre, $p_apellido, $p_curso, $p_nivel);
    echo json_encode($var);
}
function update($input){
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_POST['nombre'];
    $p_apellido = !empty($input['apellido']) ? $input['apellido'] : $_POST['apellido'];
    $p_curso = !empty($input['curso']) ? $input['curso'] : $_POST['curso'];
    $p_nivel = !empty($input['nivel']) ? $input['nivel'] : $_POST['nivel'];
    $objIns = new InscripcionesModel();
    $var = $objIns->update($p_id, $p_nombre, $p_apellido, $p_curso, $p_nivel);
    echo json_encode($var);
}
function delete($input){
    $p_id = !empty($input['id']) ? $input['id'] : $_POST['id'];
    $objIns = new InscripcionesModel();
    $var = $objIns->delete($p_id);
    echo json_encode($var);
}
