<?php
define("DEVELOPER", false);
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/ws/include/"); //agenda
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

//$respuesta = new clsWsRespuesta();
//$respuesta = new clsWsRespuesta();
switch($request_method){
    case 'POST':
        require_once FOLDER_INCLUDE . "lib/webservice/requestParametros.php";
/*        require_once FOLDER_MODEL_EXTEND . "model.tasesion_app.inc.php";
        $sesion = new ModeloTasesion_app();
        $id = intval($sesion->comprobarToken($_POST['token']));
        if ($id > 0) {
            $sesion->setFisesion_id($id);
            $ultimaSesion = $sesion->getFdfecha_ultima_peticion();
            $fechaSesion = new DateTime($ultimaSesion);
            $fechaActual = new DateTime(date("Y-m-d H:i:s"));
            $diff = $fechaSesion->diff($fechaActual);
            $segundos = (($diff->days * 24) * 60 * 60) + ($diff->h * 60 * 60) + ($diff->i * 60) + $diff->s;
            if ($segundos > $tiempoSegSesion) {
                $sesion->setFisesion_id($id);
                $sesion->setFcestatusInactiva();
                $sesion->Guardar();
                respuestaError("El tiempo de sesi&oacute;n ha excesido ", false);
            }
        } else {
            respuestaError("No se encontr&oacute; el token");
        }
  */      switch ($_POST["accion"]){
          
			case "guardarVisita":
			
					require_once FOLDER_MODEL_EXTEND . "model.visita.inc.php";
					$visita = new ModeloVisita();
					$arrRes=$visita->guardarDatos($parametros);
					//if(count($arrRes)>0){
						if (array_key_exists('error', $arrRes))
						{
							respuestaError("Error. ". $arrRes['error']);
						}
						else
							$mensaje = "OK";
					//}	
					//else 
						//$mensaje = "NOK";
					
				
			break;
			
			
			default:
			    respuestaError("No se reconoce la petici&oacute;n");
			    break;
			    
        }
//        $sesion->setFdfecha_ultima_peticion($fecha);
  //      $sesion->Guardar();
        
        $respuesta = new clsWsRespuesta();
        $respuesta->setRespuesta(true);
        $respuesta->setDatos($arrRes);
		
		$respuesta->setMensaje($mensaje);
        
        break;
        
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        header('Content-Type: application/json');
		
		
        
        break;
}

//$respuesta->setDatos( $arrayData[1] );
die ( $respuesta->getJSONRespuesta() );
?>