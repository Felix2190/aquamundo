<?php

	class ModeloBaseVisita extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseVisita";

		
		var $idVisita=0;
		var $fecha='';
		var $idServicio=0;
		var $idCliente=0;

		var $__s=array("idVisita","fecha","idServicio","idCliente");
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

		
		public function setIdVisita($idVisita)
		{
			if($idVisita==0||$idVisita==""||!is_numeric($idVisita)|| (is_string($idVisita)&&!ctype_digit($idVisita)))return $this->setError("Tipo de dato incorrecto para idVisita.");
			$this->idVisita=$idVisita;
			$this->getDatos();
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setIdServicio($idServicio)
		{
			
			$this->idServicio=$idServicio;
		}
		public function setIdCliente($idCliente)
		{
			
			$this->idCliente=$idCliente;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdVisita()
		{
			return $this->idVisita;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getIdServicio()
		{
			return $this->idServicio;
		}
		public function getIdCliente()
		{
			return $this->idCliente;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idVisita=0;
			$this->fecha='';
			$this->idServicio=0;
			$this->idCliente=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO visita(fecha,idServicio,idCliente)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->idServicio) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCliente) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result){
					$this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseVisita::Insertar]");
					return array('error'=>$this->getStrSystemError());
				}
				$this->idVisita=mysqli_insert_id($this->dbLink);
				return array('idVisita'=>$this->idVisita);
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
				$SQL="UPDATE visita SET fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',idServicio='" . mysqli_real_escape_string($this->dbLink,$this->idServicio) . "',idCliente='" . mysqli_real_escape_string($this->dbLink,$this->idCliente) . "'
					WHERE idVisita=" . $this->idVisita;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseVisita::Update]");
				
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
				$SQL="DELETE FROM visita
				WHERE idVisita=" . mysqli_real_escape_string($this->dbLink,$this->idVisita);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseVisita::Borrar]");
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
						idVisita,fecha,idServicio,idCliente
					FROM visita
					WHERE idVisita=" . mysqli_real_escape_string($this->dbLink,$this->idVisita);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseVisita::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			/*if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;*/
			if($this->idVisita==0)
				return $this->Insertar();
			else
				return $this->Actualizar();
			/*if($this->getError())
				return false;
			return true;*/
		}
		
	}

?>