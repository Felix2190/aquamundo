<?php


require FOLDER_MODEL_BASE . "model.base.talogin.inc.php";
require_once FOLDER_MODEL_EXTEND.'model.tapermisos.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.tabitacora_login.inc.php";

class ModeloTalogin extends ModeloBaseTalogin
{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
	var $_nombreClase="ModeloBaseTalogin";

	var $__ss=array();


		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#


	function __construct()
	{
		parent::__construct();
	}

	function __destruct()
	{

	}


		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

	public function validarUsuarioPassword($infoUsuario)
	{
	    require_once FOLDER_MODEL_EXTEND.'model.tausuario_sucursal.inc.php';
	    $query = "SELECT * from talogin WHERE fcuser_name ='" . mysqli_real_escape_string($this->dbLink, $infoUsuario['username']) . "'  LIMIT 1";
   
		$result = mysqli_query($this->dbLink, $query);// se  ejecuta el query para comprovar si existe el usuario
		if ($result) {
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$password = hash('sha512', $infoUsuario['password'] . $row['fcsemilla']);//encriptamos el password con la semilla que esta en la base de datos 
				if ($row['fcpassword'] == $password) {//	verificamos si la contraseña de la base de datos es igual a la que ingresamos
				    //verificamos que el usuario est� relacionado con una sucursal
				    $usuarioSucursal = new ModeloTausuario_sucursal();
				    $idSucursalUsuario=$usuarioSucursal->comprobarUsuarioSucursal($row['fiusuario_id'], $row['fisucursal_id']);
				    if ($idSucursalUsuario==0){
				        return array(false,'Error... el usuario no est&aacute; ligado a ninguna sucursal');
				    }
					$arrInfoUsuario =$this->obtenerDatosUsuario($row['fiusuario_id']);// si son iguales obtenemos sus datos 
					if (count($arrInfoUsuario) > 0) {
						if ($row['fcestautus_login']=='Activo') {// verificamos si se encuentra activo

							$query3 = "SELECT * FROM taempresa";
							$empresa=mysqli_query($this->dbLink, $query3);
							if ($empresa && mysqli_num_rows($empresa) > 0) {//obtenemos los datos de la empresa
								$row_inf = mysqli_fetch_assoc($empresa);
								
							} 

							$permisos= new ModeloTapermisos();//obtenemos el menu
							if (!isset($_SESSION['submenus'])){
								$_SESSION['submenus']=$permisos->getMenusSubmenus();
							}

							if (!isset($_SESSION['submenus_rol'])){//obtenemos los submenus dependiendo el rol
								$_SESSION['submenus_rol']=$permisos->getMenusSubmenusByIdRol($row['firol_id']);
							}
							
							require_once FOLDER_MODEL_EXTEND.'model.tasucursal.inc.php';
							require_once FOLDER_MODEL_EXTEND.'model.tarol.inc.php';
							// obtiene informaci�n relacionada al usuario
							$ubicacion = new ModeloTasucursal();
							$ubicacion->setFisucursal_id($idSucursalUsuario);
							
							$rol = new ModeloTarol();
							$rol->setFirol_id($row['firol_id']);

							$arrInfoUsuario['userName'] = $infoUsuario['username'];//usuario
							$arrInfoUsuario['nombreCompleto'] = $arrInfoUsuario['fcnombre']." ".$arrInfoUsuario['fcapellido_paterno']." ".$arrInfoUsuario['fcapellido_materno'];
							$arrInfoUsuario['idRol'] = $row['firol_id'];//id rol
							$arrInfoUsuario['idSucursal'] = $idSucursalUsuario;//id sucursal
							$arrInfoUsuario['estilo_css'] = $row['fcestilo_css'];//estilo
							$arrInfoUsuario['idUsuario'] =$row['fiusuario_id'];//id usuario
							$arrInfoUsuario['acceso'] = 'web';// se asigna acceso web
							$arrInfoUsuario['campo'] =$row_inf['fccampo_articulo'];// campo que usara la empresa
							$arrInfoUsuario['sucursal']= $ubicacion->getFcnombre_sucursal(); //nombre de la sucursal
							$arrInfoUsuario['rol']= $rol->getFcnombre_rol(); // nombre del rol
							$arrInfoUsuario['empresa'] =$row_inf['fcnombre'];// campo que usara la empresa
							

							$bitacora =$this->registroBitacora($idSucursalUsuario,$row['fiusuario_id'],'web');
							if ($bitacora =='true') {//si se hizo registro en la bitacora 
							    $query = "UPDATE talogin SET fisucursal_id = $idSucursalUsuario WHERE filogin_id = ".$row['filogin_id'];
							    $result = mysqli_query($this->dbLink, $query);
							    if (!$result){
							        // error al actualizar sucursal
							        return array(false,'Error al actualizar sucursal');
							    }
								return array(true,$arrInfoUsuario);	# retorna el array
							}else{ 
								return array(false,'Bitacora no registrada.');//manda un mensaje si no se registro la nitacora
							}
							
						}else{
                            //_usuario bloqueado
							return array(false,'Tu cuenta ha sido bloqueada, contacte al administador para activar su cuenta.');
						}
					}else {
                        // error al encontrar el usuario
						return array(false,'Error al cargar los datos del usuario');
					}
				} else {
                    // contraseña incorrecta
					return array(false,'La contrase&ntilde;a ingresada es incorrecta');
				}
			} else {
                // El usuario no existe.
				return array(false,'El usuario no se encontr&oacute; en el sistema');
			}
		} else {
            // die("[" . $query . "]" . mysqli_error($mysqli));
			return array(false,mysqli_error($mysqli));
		}
	}

	public function obtenerDatosUsuario($idUsuario)
	{//obtenemos los datos del usuario
		$query = "Select u.fiusuario_id,u.fcurl_foto_usr as foto, u.fcnombre, u.fcapellido_paterno,u.fcapellido_materno, t.fcnombre_rol as tarol,t.firol_id,s.fisucursal_id, s.fcnombre_sucursal, m.NOM_MUN as lugar, u.fccorreo as correo, u.fiusuario_id, l.filogin_id from tausuario as u  inner join talogin as l on u.fiusuario_id=l.fiusuario_id inner join tarol as t on l.firol_id=t.firol_id inner join tasucursal as s on l.fisucursal_id=s.fisucursal_id inner join inegidomgeo_cat_municipio as m on CVE_ENT=s.fcestado_id and CVE_MUN=s.fcmunicipio_id  where u.fiusuario_id=" . $idUsuario;
		$arreglo = array();
		$resultado = mysqli_query($this->dbLink, $query);
		if ($resultado && mysqli_num_rows($resultado) > 0) {
			$row_inf = mysqli_fetch_assoc($resultado);
			$arreglo = $row_inf;
		}
		return $arreglo;
	}

	public function validarUsername($username)
	{//valida el username
		$query = "SELECT * FROM talogin WHERE fcuser_name='".$username."'";
		$arreglo = array();
		$resultado = mysqli_query($this->dbLink, $query);
		if ($resultado && mysqli_num_rows($resultado) > 0) {
			$row_inf = mysqli_fetch_assoc($resultado);
			$arreglo = $row_inf;
		}
		return $arreglo;

	}
/*	function validaPassword($password)
	{
		global $objSession;
		$query = "SELECT * from login WHERE idUsuario =".$objSession->getidUsuario();
		$result = mysqli_query($this->dbLink, $query);
		if ($result && mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			$password = hash('sha512', $password . $row['salt']);
			if ($row['password'] == $password) {
				return 'true';
			}
		}
		return 'false';
	}
*/
	function cambiaPassword($password)
	{
		global $objSession;
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$passwordSalt = hash('sha512', $password. $random_salt);

		$query = "update login set password='$passwordSalt', salt='$random_salt' WHERE idUsuario =".$objSession->getidUsuario();
		$result = mysqli_query($this->dbLink, $query);
		if ($result) 
			return 'true';

		return 'false';
	}

	
	function registroBitacora($idSucursal,$idUsuario,$tipoAcesso)
	{//registro de la bitacora 
		date_default_timezone_set('America/Mexico_City');
		$fecha = date('Y-m-j H:i:s'); 
		$nuevafecha = strtotime ( '-6 hour' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j H:i:s' , $nuevafecha );
		$query = "INSERT INTO `tabitacora_login`( `fisucursal_id`, `fcusuario_id`, `fctipo_acceso`, `fdfecha_acceso`) VALUES ('$idSucursal','$idUsuario','$tipoAcesso','$nuevafecha')";
		$result = mysqli_query($this->dbLink, $query);
		if ($result) 
			return 'true';

		return 'false';
	}

	public function validarCampo($tabla,$campo,$valor)
	{
		$query = "SELECT * from $tabla WHERE $campo ='" . mysqli_real_escape_string($this->dbLink, $valor) . "'  LIMIT 1";
		$result = mysqli_query($this->dbLink, $query);
        //return $query;
		if ($result) {
			if (mysqli_num_rows($result) == 1) {
				return 'false';
			}
			return 'true';
		}else {
			return 'false';
		}
	}

	public function getDatosByIdUsuario()
	{
		try
		{
			$SQL="SELECT
			*
			FROM talogin
			WHERE fiusuario_id=" . mysqli_real_escape_string($this->dbLink,$this->idUsuario);

			$result=mysqli_query($this->dbLink,$SQL);
			if(!$result)
				return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseLogin::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");


			if(mysqli_num_rows($result)==0)
			{
				$this->limpiarPropiedades();
			}
			else
			{
				$datos=mysqli_fetch_assoc($result);
				foreach($datos as $k=>$v)
				{
					$campo="" . $k;
					$this->$campo=$v;
				}
			}
			return true;
		}
		catch (Exception $e)
		{
			return $this->setErrorCatch($e);
		}
	}

	public function validarUserPassAPP($infoUsuario)
	{
	    $query = "SELECT * from talogin WHERE fcuser_name ='" . mysqli_real_escape_string($this->dbLink, $infoUsuario['username']) . "'  LIMIT 1";
	    
	    $result = mysqli_query($this->dbLink, $query);// se  ejecuta el query para comprovar si existe el usuario
	    if ($result) {
	        if (mysqli_num_rows($result) == 1) {
	            $row = mysqli_fetch_assoc($result);
	            $password = hash('sha512', $infoUsuario['password'] . $row['fcsemilla']);//encriptamos el password con la semilla que esta en la base de datos
	            if ($row['fcpassword'] == $password) {//	verificamos si la contraseña de la base de datos es igual a la que ingresamos
	                $arrInfoUsuario =$this->obtenerDatosUsuario($row['fiusuario_id']);// si son iguales obtenemos sus datos
	                if (count($arrInfoUsuario) > 0) {
	                    if ($row['fcestautus_login']=='Activo') {// verificamos si se encuentra activo
	                        
	                        require_once FOLDER_MODEL_EXTEND.'model.tasucursal.inc.php';
	                        require_once FOLDER_MODEL_EXTEND.'model.tarol.inc.php';
	                        // obtiene informaci�n relacionada al usuario
	                        $ubicacion = new ModeloTasucursal();
	                        $ubicacion->setFisucursal_id($row['fisucursal_id']);
	                        
	                        $rol = new ModeloTarol();
	                        $rol->setFirol_id($row['firol_id']);
	                        
	                        $arrInfoUsuario['userName'] = $infoUsuario['username'];//usuario
	                        $arrInfoUsuario['nombreCompleto'] = $arrInfoUsuario['fcnombre']." ".$arrInfoUsuario['fcapellido_paterno']." ".$arrInfoUsuario['fcapellido_materno'];
	                        $arrInfoUsuario['idRol'] = $row['firol_id'];//id rol
	                        $arrInfoUsuario['idSucursal'] = $row['fisucursal_id'];//id sucursal
	                        $arrInfoUsuario['idUsuario'] =$row['fiusuario_id'];//id usuario
	                        $arrInfoUsuario['acceso'] = 'app';//
	                        $arrInfoUsuario['sucursal']= $ubicacion->getFcnombre_sucursal(); //nombre de la sucursal
	                        $arrInfoUsuario['rol']= $rol->getFcnombre_rol(); // nombre del rol
	                        return array(true,$arrInfoUsuario);	# retorna el array
	                        
	                    }else{
	                        //_usuario bloqueado
	                        return array(false,'Tu cuenta ha sido bloqueada, contacte al administador para activar su cuenta.');
	                    }
	                }else {
	                    // error al encontrar el usuario
	                    return array(false,'Error al cargar los datos del usuario');
	                }
	            } else {
	                // contraseña incorrecta
	                return array(false,'La contrase&ntilde;a ingresada es incorrecta');
	            }
	        } else {
	            // El usuario no existe.
	            return array(false,'El usuario no se encontr&oacute; en el sistema');
	        }
	    } else {
	        // die("[" . $query . "]" . mysqli_error($mysqli));
	        return array(false,mysqli_error($mysqli));
	    }
	}
	

public function obtenerUsuarios()
		{
		    $query = "Select l.fiusuario_id, concat(fcnombre,' (', fcuser_name, ')')as fcuser_name from talogin l  join tausuario u on l.fiusuario_id = u.fiusuario_id 
		    		where l.fcestautus_login <> 'Suspendido'  ";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		        $arreglo[$row_inf['fiusuario_id']] = $row_inf['fcuser_name'];
		        }
		    }
		    return $arreglo;
		}


    public function verificaUsername($username){
        $query = "SELECT * FROM talogin WHERE fcuser_name='".$username."'";
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $d=rand(10,99);
            $username=$username.$d;           
            return array(true,$username);
        }else{
            return array(false);
        }
    }
    

	public function validarDatos()
	{
		return true;
	}


}


