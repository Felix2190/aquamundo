<?php
define("DEVELOPER", false);
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/include/"); //agenda
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/aquamundo/ws/include/");
}
define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php'); 

define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/"); 
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");
define("CLASS_SESSION", FOLDER_INCLUDE . "model/data/clsSession.inc.php");
define("CLASS_COMUN", FOLDER_INCLUDE. "model/data/clsBasicCommon.inc.php");

date_default_timezone_set('America/Mexico_City');

//define("FOLDER_CONTROLLER", FOLDER_INCLUDE . "controler/");
require_once(CLASS_COMUN);
require_once CLASS_SESSION;
require_once FOLDER_INCLUDE . "lib/webservice/wsRespuesta.inc.php";

$request_method=$_SERVER["REQUEST_METHOD"];
$fecha = date("Y-m-d H:i:s");

switch($request_method){
    case 'POST':
        require_once FOLDER_INCLUDE . "lib/webservice/requestParametros.php";

        switch ($_POST["accion"]){
            case "inegiestados":
                require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_estado.inc.php";
                $estados = new ModeloInegidomgeo_cat_estado();
                $arrRes=$estados->obtenerEstados();
                break;
            case "inegimunicipios":
                require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_municipio.inc.php";
                $mun = new ModeloInegidomgeo_cat_municipio();
                $arrRes=$mun->obtenerMunicipioXestado($parametros["cve_estado"]);
                
            default:
                respuestaError("No se reconoce la petici&oacute;n");
                break;
        }
        
        $respuesta = new clsWsRespuesta();
        $respuesta->setRespuesta(true);
        $respuesta->setDatos($arrRes);
        
        break;
        
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        header('Content-Type: application/json');
        break;
}

//$respuesta->setDatos( $arrayData[1] );
die ( $respuesta->getJSONRespuesta() );
?>