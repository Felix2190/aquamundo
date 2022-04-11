<?php

	class ModeloBaseEmpleado extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEmpleado";

		
		var $idEmpleado=0;
		var $nombre='';
		var $foto='';
		var $idRol=0;

		var $__s=array("idEmpleado","nombre","foto","idRol");
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

		
		public function setIdEmpleado($idEmpleado)
		{
			if($idEmpleado==0||$idEmpleado==""||!is_numeric($idEmpleado)|| (is_string($idEmpleado)&&!ctype_digit($idEmpleado)))return $this->setError("Tipo de dato incorrecto para idEmpleado.");
			$this->idEmpleado=$idEmpleado;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setFoto($foto)
		{
			$this->foto=$foto;
		}
		public function setIdRol($idRol)
		{
			
			$this->idRol=$idRol;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEmpleado()
		{
			return $this->idEmpleado;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getFoto()
		{
			return $this->foto;
		}
		public function getIdRol()
		{
			return $this->idRol;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEmpleado=0;
			$this->nombre='';
			$this->foto='';
			$this->idRol=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO empleado(nombre,foto,idRol)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->foto) . "','" . mysqli_real_escape_string($this->dbLink,$this->idRol) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEmpleado::Insertar]");
				
				$this->idEmpleado=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE empleado SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',foto='" . mysqli_real_escape_string($this->dbLink,$this->foto) . "',idRol='" . mysqli_real_escape_string($this->dbLink,$this->idRol) . "'
					WHERE idEmpleado=" . $this->idEmpleado;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEmpleado::Update]");
				
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
				$SQL="DELETE FROM empleado
				WHERE idEmpleado=" . mysqli_real_escape_string($this->dbLink,$this->idEmpleado);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEmpleado::Borrar]");
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
						idEmpleado,nombre,foto,idRol
					FROM empleado
					WHERE idEmpleado=" . mysqli_real_escape_string($this->dbLink,$this->idEmpleado);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEmpleado::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEmpleado==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>