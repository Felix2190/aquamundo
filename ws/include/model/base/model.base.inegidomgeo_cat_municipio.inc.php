<?php

	class ModeloBaseInegidomgeo_cat_municipio extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseInegidomgeo_cat_municipio";

		
		var $CVE_ENT='';
		var $CVE_MUN='';
		var $NOM_MUN='';

		var $__s=array("CVE_ENT","CVE_MUN","NOM_MUN");
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
		public function setCVE_MUN($CVE_MUN)
		{
			if(trim($CVE_MUN)=="")return $this->setError("El valor CVE_MUN no puede ser vacio.");
			$this->CVE_MUN=$CVE_MUN;
			$this->getDatos();
		}
		public function setNOM_MUN($NOM_MUN)
		{
			
			$this->NOM_MUN=$NOM_MUN;
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
		public function getCVE_MUN()
		{
			return $this->CVE_MUN;
		}
		public function getNOM_MUN()
		{
			return $this->NOM_MUN;
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
			$this->CVE_MUN='';
			$this->NOM_MUN='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO inegidomgeo_cat_municipio(CVE_ENT,NOM_MUN)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "','" . mysqli_real_escape_string($this->dbLink,$this->NOM_MUN) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseInegidomgeo_cat_municipio::Insertar]");
				
				$this->CVE_MUN=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE inegidomgeo_cat_municipio SET CVE_ENT='" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "',NOM_MUN='" . mysqli_real_escape_string($this->dbLink,$this->NOM_MUN) . "'
					WHERE CVE_MUN=" . $this->CVE_MUN;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_municipio::Update]");
				
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
				$SQL="DELETE FROM inegidomgeo_cat_municipio
				WHERE CVE_MUN=" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_municipio::Borrar]");
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
						CVE_ENT,CVE_MUN,NOM_MUN
					FROM inegidomgeo_cat_municipio
					WHERE CVE_MUN=" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseInegidomgeo_cat_municipio::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->CVE_MUN==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>