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
        require_once FOLDER_MODEL_EXTEND . "model.tausuario.inc.php";
        $url = 'http://www.pruebassointec.com.mx/';
        switch ($_POST["accion"]){
            case "listado":
                $usuario = new Modelousuario();
                $arrRes = $usuario->obtenerUsuarios();
                break;
            case "buscar":
                $usuario = new Modelousuario();
                $arrRes = $usuario->obtenerUsuarios($parametros['nombre']);
                break;
            case "detalle":
                $usuario = new Modelousuario();
                $arrRes = $usuario->obtenerUsuario($parametros['id']);
                if (count($arrRes) > 0) {
                    $usuario->setFiusuario_id($arrRes['usuario_registro']);
                    $arrRes['fotoBinario'] = bin2hex(file_get_contents($url . $arrRes['fotoBinario']));
                    $arrRes['usuario_registro'] = $usuario->getFcnombre() . " " . $usuario->getFcapellido_paterno() . " " . $usuario->getFcapellido_materno();
                    require_once FOLDER_MODEL_EXTEND . "model.tabitacora_login.inc.php";
                    $bitacora = new ModeloBitacora_login();
                    $arrBitacora = $bitacora->ultimaSesionByUsuario($parametros['id']);
                    if (count($arrBitacora) > 0) {
                        $arrRes['fecha_ultima_sesion'] = $arrBitacora['fecha'];
                        $arrRes['hora_ultima_sesion'] = $arrBitacora['hora'];
                        $arrRes['tipo_sesion'] = $arrBitacora['tipo'];
                    }
                }
                break;
            case "nuevo":
                require_once FOLDER_MODEL_EXTEND . "model.talogin.inc.php";
                $usuario = new Modelousuario();
                $login = new Modelologin();
                $verifUser = $login->verificaUsername($parametros['username']);
                if ($verifUser[0])
                    respuestaError("El usernamne ingresado ya est&aacute; en uso, podr&iacute;s usar " . $verifUser[1]);
                
                if ($usuario->verificaCorreo($parametros['correo']))
                        respuestaError("El correo ya fue registrado");
                $passw = substr(md5(microtime()), 1, 10);
                $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                $password = hash('sha512', $passw . $random_salt);
                try {
                    $content = bin2hex(file_get_contents($url . "tmp/fotosperfil/default.png"));
                    $ifp2 = fopen("/var/www/vhosts/pruebassointec.com.mx/httpdocs/tmp/fotos perfil/" . $parametros["username"] . ".png", "wb");
                    fwrite($ifp2, base64_decode($content));
                    fclose($ifp2);
                } catch (\Exception $e) {
                    respuestaError("Error al generar la imagen de usuario ");
                }
                
                $usuario->setFcnombre($parametros['nombre']);
                $usuario->setFcapellido_paterno($parametros['apaterno']);
                $usuario->setFcapellido_materno($parametros['amaterno']);
                $usuario->setFcdireccion($parametros['direccion']);
                $usuario->setFccorreo($parametros['correo']);
                $usuario->setFiusuario_registro_id($sesion->getFiusuario_id());
                $usuario->setFcstatus_usrActivo();
                $usuario->setFdfecha_registro($fecha);
                $usuario->setFdultima_modif($fecha);
                $usuario->setFcusr_modifico($sesion->getFiusuario_id());
                $usuario->setFcurl_foto_usr("tmp/fotoperfil/" . $parametros["username"]);
                $usuario->Guardar();
                
                if ($usuario->getError())
                    respuestaError("No se pudo guardar correctamente el usuario [1]");
                
                $login->setFiusuario_id($usuario->getFiusuario_id());
                $login->setFirol_id(intval($parametros['idRol']));
                $login->setFisucursal_id(intval($parametros['idSucursal']));
                $login->setFcuser_name($parametros['username']);
                $login->setFcpassword($password);
                $login->setFcsemilla($random_salt); 
                $login->setFcestilo_css('style.azulR');
                $login->setFcestautus_login('Activo');
                $login->setFiusuario_registro_id($sesion->getFiusuario_id());
                $login->setFdfecha_registro($fecha);
                $login->Guardar();
                
                if ($login->getError())
                    respuestaError("No se pudo guardar correctamente el usuario [2]");
                    
                    define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");
                    
                    require_once  FOLDER_INCLUDE . "controler/correo.inc.php";
                if (!correo($parametros['correo'],'Datos de usuario','Usuario: '.$parametros['username'].'<br>Contraseña: '.$passw))
                    $arrRes="Registro Exitoso!, sin enviar el correo con datos de acceso";
                    
                    $usuario->setFienvio_correo();
                    $usuario->Guardar();
                    
                    $arrRes="Registro exitoso!";
                    break;
        }
        
        $sesion->setFdfecha_ultima_peticion($fecha);
        $sesion->Guardar();
        
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