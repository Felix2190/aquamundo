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
		            $password = hash('sha512', $infoUsuario['password'] . $row['salt']);//encriptamos el password con la semilla que esta en la base de datos
		            if ($row['password'] == $password) {//	verificamos si la contraseña de la base de datos es igual a la que ingresamos
		                $arrInfoUsuario =$this->obtenerDatosUsuario($row['idUsuario']);// si son iguales obtenemos sus datos
		                if (count($arrInfoUsuario) > 0) {
		                    if ($row['estatus']=='activo') {// verificamos si se encuentra activo
		                        $arrInfoUsuario['userName'] = $infoUsuario['username'];//usuario
		                        $arrInfoUsuario['nombreCompleto'] = $arrInfoUsuario['nombre']." ".$arrInfoUsuario['apellidos'];
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
		                return array(false,'La contrase&ntilde;a ingresada es incorrecta ');
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
		    $query = "Select u.idUsuario, nombre, apellidos from usuario as u  inner join login as l on u.idUsuario=l.idUsuario where u.idUsuario=" . $idUsuario;
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        $arreglo = $row_inf;
		    }
		    return $arreglo;
		}
		
		
	}

