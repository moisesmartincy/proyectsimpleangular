<?php
define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

define("RUTA_BASE",$_SERVER['DOCUMENT_ROOT']."/");
define("HTTP_BASE","http://127.0.0.1/");
define('ROOT_DIR',RUTA_BASE.'appweb');
define('ROOT_CORE',RUTA_BASE.'appweb/core');
define('ROOT_UPLOAD',RUTA_BASE.'appweb/uploads');
define('ROOT_REPORT',RUTA_BASE.'appweb/reports');
define('ROOT_REPORT_DOWN',RUTA_BASE.'appweb/reports_download');
//define("URL_RESOURCES", DIR_SIS."/public/resources/");
define("URL_RESOURCES", "http://127.0.0.1/appweb/resources");
//JWT TOKEN
define('SECRET_KEY','MIEMPRESA.MBmxKMifghY7d55sghvTlB1jyAjB3uN0g6ZDdOXpz21');  // secret key can be a random string and keep in secret from anyone
define('ALGORITHM','HS256');   // Algorithm used to sign the token



?>