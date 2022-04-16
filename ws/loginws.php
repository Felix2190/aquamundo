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
        $respuesta = new clsWsRespuesta();
        $respuesta->setRespuesta( true);
                
        if ($_POST['accion'] == "iniciar") {
            $arrayData = validarUsuario();
            if (! $arrayData[0])
                respuestaError($arrayData[1]);
            $arrInfo = $arrayData[1];

        }else {
                respuestaError("No se reconoce la petici&oacute;n");
        }
        break;
        
        default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//$respuesta->setDatos( $arrayD-ata[1] );
die ( $respuesta->getJSONRespuesta() );


function validarUsuario(){
    global $parametros;
    require_once FOLDER_MODEL_EXTEND . "model.login.inc.php";
    $user=$parametros["username"];
    $pass=$parametros["password"];
    
    $user1 = new ModeloLogin();
    // $respuesta = $user->validarUsername($user);
    $respuesta = $user1->validarUserPassAPP(array('username'=>$user,'password'=>$pass));
    
    header('Content-Type: application/json');
    return $respuesta;
}

?>