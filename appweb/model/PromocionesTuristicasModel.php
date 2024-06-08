<?php
include_once "../core/ModeloBasePDO.php";
class PromocionesTuristicasModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findall()
    {
        $sql = " SELECT id, 
        nombre_servicio, 
        descripcion, 
        numero_camaras, 
        tipo_camara, 
        garantia, 
        tiempo_instalacion, 
        monitoreo_remoto, 
        precio 
        FROM servicios_instalacion_camaras ";
        $param = array();
        return parent::gselect($sql, $param);
    }


    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = " SELECT id, 
        nombre_servicio, 
        descripcion, 
        numero_camaras, 
        tipo_camara, 
        garantia, 
        tiempo_instalacion, 
        monitoreo_remoto, 
        precio 
        FROM servicios_instalacion_camaras
 WHERE upper(concat(IFNULL(id,''),IFNULL(nombre_servicio,''),IFNULL(descripcion,''),IFNULL(numero_camaras,''),
 IFNULL(tipo_camara,''),IFNULL(garantia,''),IFNULL(tiempo_instalacion,''),IFNULL(monitoreo_remoto,''),IFNULL(precio,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') 
 limit :p_limit 
 offset :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var =  parent::gselect($sql, $param);
        $sqlCount = "SELECT count(1) as cant
        FROM servicios_instalacion_camaras
        WHERE upper(concat(IFNULL(id,''),IFNULL(nombre_servicio,''),IFNULL(descripcion,''),IFNULL(numero_camaras,''),
 IFNULL(tipo_camara,''),IFNULL(garantia,''),IFNULL(tiempo_instalacion,''),IFNULL(monitoreo_remoto,''),IFNULL(precio,''))) like  CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%')  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 =  parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    function findId($p_id)
    {
        $sql = "SELECT id, 
        nombre_servicio, 
        descripcion, 
        numero_camaras, 
        tipo_camara, 
        garantia, 
        tiempo_instalacion, 
        monitoreo_remoto, 
        precio 
        FROM servicios_instalacion_camaras
   WHERE id = :p_id; ";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param);
        return $var;
    }
    public function insert($p_nombre_servicio, $p_descripcion, $p_numero_camaras, $p_tipo_camara, $p_garantia, $p_tiempo_instalacion, $p_monitoreo_remoto, $p_precio)
    {
        $sql = "INSERT INTO servicios_instalacion_camaras
      ( nombre_servicio, 
        descripcion, 
        numero_camaras, 
        tipo_camara, 
        garantia, 
        tiempo_instalacion, 
        monitoreo_remoto, 
        precio ) 
      VALUES (:p_nombre_servicio, :p_descripcion, :p_numero_camaras, :p_tipo_camara, :p_garantia, :p_tiempo_instalacion, :p_monitoreo_remoto, :p_precio) 
       ";
        $param = array();
        array_push($param, [':p_nombre_servicio', $p_nombre_servicio, PDO::PARAM_INT]);
        array_push($param, [':p_descripcion', $p_descripcion, PDO::PARAM_INT]);
        array_push($param, [':p_numero_camaras', $p_numero_camaras, PDO::PARAM_INT]);
        array_push($param, [':p_tipo_camara', $p_tipo_camara, PDO::PARAM_STR]);
        array_push($param, [':p_garantia', $p_garantia, PDO::PARAM_STR]);
        array_push($param, [':p_tiempo_instalacion', $p_tiempo_instalacion, PDO::PARAM_STR]);
        array_push($param, [':p_monitoreo_remoto', $p_monitoreo_remoto, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        $var = parent::ginsert($sql, $param);
        return $var;
    }
    public function update($p_id,$p_nombre_servicio, $p_descripcion, $p_numero_camaras, $p_tipo_camara, $p_garantia, $p_tiempo_instalacion, $p_monitoreo_remoto, $p_precio)
    {
        $sql = "UPDATE servicios_instalacion_camaras 
      SET 
      nombre_servicio=:p_nombre_servicio,
      descripcion=:p_descripcion,
      numero_camaras=:p_numero_camaras,
      tipo_camara=:p_tipo_camara,
      garantia=:p_garantia,
      tiempo_instalacion=:p_tiempo_instalacion,
      monitoreo_remoto=:p_monitoreo_remoto,
      precio=:p_precio 
      WHERE id = :p_id";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        array_push($param, [':p_nombre_servicio', $p_nombre_servicio, PDO::PARAM_INT]);
        array_push($param, [':p_descripcion', $p_descripcion, PDO::PARAM_INT]);
        array_push($param, [':p_numero_camaras', $p_numero_camaras, PDO::PARAM_INT]);
        array_push($param, [':p_tipo_camara', $p_tipo_camara, PDO::PARAM_STR]);
        array_push($param, [':p_garantia', $p_garantia, PDO::PARAM_STR]);
        array_push($param, [':p_tiempo_instalacion', $p_tiempo_instalacion, PDO::PARAM_STR]);
        array_push($param, [':p_monitoreo_remoto', $p_monitoreo_remoto, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        $var = parent::gupdate($sql, $param);
        return $var;
    }
    function delete($p_id)
    {

        $sql = "DELETE FROM promociones_turisticas WHERE id = :p_id ";
        $param = array();
        array_push($param, [':p_id', $p_id, PDO::PARAM_INT]);
        $var = parent::gdelete($sql, $param);
        return $var;
    }
}
