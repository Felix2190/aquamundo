<?php

	class ModeloBaseInegidomgeo_cat_estado extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseInegidomgeo_cat_estado";

		
		var $CVE_ENT='';
		var $NOM_ENT='';

		var $__s=array("CVE_ENT","NOM_ENT");
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

		
		public function setCVE_ENT($CVE_ENT)
		{
			if(trim($CVE_ENT)=="")return $this->setError("El valor CVE_ENT no puede ser vacio.");
			$this->CVE_ENT=$CVE_ENT;
			$this->getDatos();
		}
		public function setNOM_ENT($NOM_ENT)
		{
			
			$this->NOM_ENT=$NOM_ENT;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getCVE_ENT()
		{
			return $this->CVE_ENT;
		}
		public function getNOM_ENT()
		{
			return $this->NOM_ENT;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->CVE_ENT='';
			$this->NOM_ENT='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO inegidomgeo_cat_estado(NOM_ENT)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->NOM_ENT) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseInegidomgeo_cat_estado::Insertar]");
				
				$this->CVE_ENT=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE inegidomgeo_cat_estado SET NOM_ENT='" . mysqli_real_escape_string($this->dbLink,$this->NOM_ENT) . "'
					WHERE CVE_ENT=" . $this->CVE_ENT;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_estado::Update]");
				
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
				$SQL="DELETE FROM inegidomgeo_cat_estado
				WHERE CVE_ENT=" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_estado::Borrar]");
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
						CVE_ENT,NOM_ENT
					FROM inegidomgeo_cat_estado
					WHERE CVE_ENT=" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseInegidomgeo_cat_estado::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->CVE_ENT==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>