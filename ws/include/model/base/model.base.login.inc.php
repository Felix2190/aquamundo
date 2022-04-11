<?php

	class ModeloBaseLogin extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseLogin";

		
		var $idLogin=0;
		var $idUsuario=0;
		var $userName='';
		var $password='';
		var $salt='';
		var $estatus='activo';

		var $__s=array("idLogin","idUsuario","userName","password","salt","estatus");
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

		
		public function setIdLogin($idLogin)
		{
			if($idLogin==0||$idLogin==""||!is_numeric($idLogin)|| (is_string($idLogin)&&!ctype_digit($idLogin)))return $this->setError("Tipo de dato incorrecto para idLogin.");
			$this->idLogin=$idLogin;
			$this->getDatos();
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setUserName($userName)
		{
			
			$this->userName=$userName;
		}
		public function setPassword($password)
		{
			$this->password=$password;
		}
		public function setSalt($salt)
		{
			$this->salt=$salt;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusInactivo()
		{
			$this->estatus='inactivo';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdLogin()
		{
			return $this->idLogin;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getUserName()
		{
			return $this->userName;
		}
		public function getPassword()
		{
			return $this->password;
		}
		public function getSalt()
		{
			return $this->salt;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idLogin=0;
			$this->idUsuario=0;
			$this->userName='';
			$this->password='';
			$this->salt='';
			$this->estatus='activo';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO login(idUsuario,userName,password,salt,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->userName) . "','" . mysqli_real_escape_string($this->dbLink,$this->password) . "','" . mysqli_real_escape_string($this->dbLink,$this->salt) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseLogin::Insertar]");
				
				$this->idLogin=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE login SET idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',userName='" . mysqli_real_escape_string($this->dbLink,$this->userName) . "',password='" . mysqli_real_escape_string($this->dbLink,$this->password) . "',salt='" . mysqli_real_escape_string($this->dbLink,$this->salt) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idLogin=" . $this->idLogin;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLogin::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM login
				WHERE idLogin=" . mysqli_real_escape_string($this->dbLink,$this->idLogin);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLogin::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						idLogin,idUsuario,userName,password,salt,estatus
					FROM login
					WHERE idLogin=" . mysqli_real_escape_string($this->dbLink,$this->idLogin);
					
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
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->idLogin==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>