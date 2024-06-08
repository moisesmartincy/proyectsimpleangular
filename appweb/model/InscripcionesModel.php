<?php
include_once "../core/ModeloBasePDO.php";
class InscripcionesModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }
    public function findall()
    {
        $sql = "SELECT id, nombre, apellido, curso, nivel FROM inscripciones; ";
        $param = array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_id)
    {
        $sql = "SELECT `id`, `nombre`, `apellido`, `curso`, `nivel`
         FROM `inscripciones`
         WHERE id = :p_id;  ";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = "SELECT `id`, `nombre`, `apellido`, `curso`, `nivel` 
        FROM `inscripciones` 
        WHERE upper(concat(IFNULL(id,''),IFNULL(nombre,''),IFNULL(apellido,''),IFNULL(curso,''),IFNULL(nivel,''))) like concat('%',upper(IFNULL(:p_filtro,'')),'%') 
        limit :p_limit
        OFFSET :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param);

        $sqlCount = "SELECT count(1)  as cant
        FROM `inscripciones` 
        WHERE 
        upper(concat(IFNULL(id,''),IFNULL(nombre,''),IFNULL(apellido,''),IFNULL(curso,''),IFNULL(nivel,''))) like  concat('%',upper(IFNULL(:p_filtro,'')),'%')";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    public function insert($p_nombre, $p_apellido, $p_curso, $p_nivel)
    {
        $sql = "INSERT INTO `inscripciones`( `nombre`, `apellido`, `curso`, `nivel`) 
        VALUES (:p_nombre, :p_apellido, :p_curso, :p_nivel);";
        $param = array();
        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_apellido', $p_apellido, PDO::PARAM_STR]);
        array_push($param, [':p_curso', $p_curso, PDO::PARAM_STR]);
        array_push($param, [':p_nivel', $p_nivel, PDO::PARAM_STR]);
        return parent::ginsert($sql, $param);
    }
    public function update($p_id, $p_nombre, $p_apellido, $p_curso, $p_nivel)
    {
        $sql = " UPDATE `inscripciones` SET 
        `nombre`=  :p_nombre, 
        `apellido`= :p_apellido,
         `curso`=:p_curso, 
         `nivel`=:p_nivel 
        WHERE `id`= :p_id ";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_apellido', $p_apellido, PDO::PARAM_STR]);
        array_push($param, [':p_curso', $p_curso, PDO::PARAM_STR]);
        array_push($param, [':p_nivel', $p_nivel, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_id)
    {
        $sql = "DELETE FROM `inscripciones` WHERE id =:p_id";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        return parent::gdelete($sql, $param);
    }
}
