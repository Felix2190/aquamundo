<?php

	require FOLDER_MODEL_BASE . "model.base.login.inc.php";

	class ModeloLogin extends ModeloBaseLogin
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseLogin";

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
		
		public function validarDatos()
		{
			return true;
		}

		public function validarUserPassAPP($infoUsuario)
		{
		    $query = "SELECT * from login WHERE userName ='" . mysqli_real_escape_string($this->dbLink, $infoUsuario['username']) . "'  LIMIT 1";
		    
		    $result = mysqli_query($this->dbLink, $query);// se  ejecuta el query para comprovar si existe el usuario
		    if ($result) {
		        if (mysqli_num_rows($result) == 1) {
		            $row = mysqli_fetch_assoc($result);
		            $password = hash('sha512', $infoUsuario['password'] . $row['semilla']);//encriptamos el password con la semilla que esta en la base de datos
		            if ($row['password'] == $password) {//	verificamos si la contraseña de la base de datos es igual a la que ingresamos
		                $arrInfoUsuario =$this->obtenerDatosUsuario($row['fiusuario_id']);// si son iguales obtenemos sus datos
		                if (count($arrInfoUsuario) > 0) {
		                    if ($row['estatus']=='activo') {// verificamos si se encuentra activo
		                        
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
		
		public function obtenerDatosUsuario($idUsuario)
		{//obtenemos los datos del usuario
		    $query = "Select idUsuario, nombre, apellidos from usuario as u  inner join login as l on u.idUsuario=l.idUsuario where u.idUsuario=" . $idUsuario;
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        $arreglo = $row_inf;
		    }
		    return $arreglo;
		}
		
		
	}

