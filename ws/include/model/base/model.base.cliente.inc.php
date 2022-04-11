<?php

	class ModeloBaseCliente extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCliente";

		
		var $idCliente=0;
		var $nombre='';
		var $apellido='';
		var $telefono='';
		var $correo_electronico='';
		var $cve_estado='';
		var $cve_municipio='';
		var $fecha_registro='';

		var $__s=array("idCliente","nombre","apellido","telefono","correo_electronico","cve_estado","cve_municipio","fecha_registro");
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

		
		public function setIdCliente($idCliente)
		{
			if($idCliente==0||$idCliente==""||!is_numeric($idCliente)|| (is_string($idCliente)&&!ctype_digit($idCliente)))return $this->setError("Tipo de dato incorrecto para idCliente.");
			$this->idCliente=$idCliente;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setApellido($apellido)
		{
			
			$this->apellido=$apellido;
		}
		public function setTelefono($telefono)
		{
			$this->telefono=$telefono;
		}
		public function setCorreo_electronico($correo_electronico)
		{
			
			$this->correo_electronico=$correo_electronico;
		}
		public function setCve_estado($cve_estado)
		{
			$this->cve_estado=$cve_estado;
		}
		public function setCve_municipio($cve_municipio)
		{
			$this->cve_municipio=$cve_municipio;
		}
		public function setFecha_registro($fecha_registro)
		{
			$this->fecha_registro=$fecha_registro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdCliente()
		{
			return $this->idCliente;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellido()
		{
			return $this->apellido;
		}
		public function getTelefono()
		{
			return $this->telefono;
		}
		public function getCorreo_electronico()
		{
			return $this->correo_electronico;
		}
		public function getCve_estado()
		{
			return $this->cve_estado;
		}
		public function getCve_municipio()
		{
			return $this->cve_municipio;
		}
		public function getFecha_registro()
		{
			return $this->fecha_registro;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idCliente=0;
			$this->nombre='';
			$this->apellido='';
			$this->telefono='';
			$this->correo_electronico='';
			$this->cve_estado='';
			$this->cve_municipio='';
			$this->fecha_registro='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO cliente(nombre,apellido,telefono,correo_electronico,cve_estado,cve_municipio,fecha_registro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellido) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "','" . mysqli_real_escape_string($this->dbLink,$this->correo_electronico) . "','" . mysqli_real_escape_string($this->dbLink,$this->cve_estado) . "','" . mysqli_real_escape_string($this->dbLink,$this->cve_municipio) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_registro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCliente::Insertar]");
				
				$this->idCliente=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE cliente SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',apellido='" . mysqli_real_escape_string($this->dbLink,$this->apellido) . "',telefono='" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "',correo_electronico='" . mysqli_real_escape_string($this->dbLink,$this->correo_electronico) . "',cve_estado='" . mysqli_real_escape_string($this->dbLink,$this->cve_estado) . "',cve_municipio='" . mysqli_real_escape_string($this->dbLink,$this->cve_municipio) . "',fecha_registro='" . mysqli_real_escape_string($this->dbLink,$this->fecha_registro) . "'
					WHERE idCliente=" . $this->idCliente;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCliente::Update]");
				
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
				$SQL="DELETE FROM cliente
				WHERE idCliente=" . mysqli_real_escape_string($this->dbLink,$this->idCliente);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCliente::Borrar]");
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
						idCliente,nombre,apellido,telefono,correo_electronico,cve_estado,cve_municipio,fecha_registro
					FROM cliente
					WHERE idCliente=" . mysqli_real_escape_string($this->dbLink,$this->idCliente);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCliente::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idCliente==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>