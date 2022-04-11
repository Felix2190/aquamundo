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
        require_once FOLDER_MODEL_EXTEND . "model.tasesion_app.inc.php";
        $respuesta = new clsWsRespuesta();
        $respuesta->setRespuesta( true);
        
        $sesion = new ModeloTasesion_app();
        
        if ($_POST['accion'] == "iniciar") {
            $arrayData = validarUsuario();
            if (! $arrayData[0])
                respuestaError($arrayData[1]);
            $arrInfo = $arrayData[1];
            require_once FOLDER_MODEL_EXTEND . "model.tabitacora_login.inc.php";
            
            $bitacora = new ModeloTabitacora_login();
            $bitacora->setFctipo_accesoApp();
            $bitacora->setFcusuario_id($arrInfo['fiusuario_id']);
            $bitacora->setFdfecha_acceso($fecha);
            $bitacora->setFisucursal_id($arrInfo['idSucursal']);
            $bitacora->Guardar();
            
            if ($bitacora->getError())
                respuestaError($bitacora->getStrError());
            
            // crear token
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $token = hash('sha1', $arrInfo['fiusuario_id'] . $random_salt);
            $fecha = date("Y-m-d H:i:s");
            
            $sesion->setFiusuario_id($arrInfo['fiusuario_id']);
            $sesion->setFctoken($token);
            $sesion->setFdfecha_acceso($fecha);
            $sesion->setFdfecha_ultima_peticion($fecha);
            $sesion->setFibitacora_login($bitacora->getFiacceso_id());
            $sesion->Guardar();
            if ($sesion->getError())
                respuestaError($sesion->getStrError());
            
            require_once FOLDER_MODEL_EXTEND . "model.taempresa.inc.php";
            $datosEmpresa = new ModeloTaempresa();
            $datosEmpresa->setFiempresa_id(1);
            $arrRes= array("token"=>$token,"nombre"=>utf8_encode($arrInfo["nombreCompleto"]),"cve_loc"=>$datosEmpresa->getFclocalidad(),"cve_ent"=>$datosEmpresa->getFcestado(),"cve_mun"=>$datosEmpresa->getFcmunicipio(),"campo_art"=>$datosEmpresa->getFccampo_articulo());
            $respuesta->setDatos($arrRes);
        
            $sesion->setFdfecha_ultima_peticion($fecha);
            $sesion->Guardar();
        
        }else {
            $id=intval($sesion->comprobarToken($_POST['token'],"no"));
            if ($id>0){
                $sesion->setFisesion_id($id);
                $sesion->setFcestatusInactiva();
                $sesion->Guardar();
            }else 
                respuestaError("No se encontr&oacute; el token");
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
    require_once FOLDER_MODEL_EXTEND . "model.talogin.inc.php";
    $user=$parametros["username"];
    $pass=$parametros["password"];
    
    $user1 = new ModeloTalogin();
    // $respuesta = $user->validarUsername($user);
    $respuesta = $user1->validarUserPassAPP(array('username'=>$user,'password'=>$pass));
    
    header('Content-Type: application/json');
    return $respuesta;
}

?>