<?php

	class ModeloBaseEncuesta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEncuesta";

		
		var $idEncuesta=0;
		var $idVisita=0;
		var $realizada='';
		var $fecha_realizacion='';
		var $pregunta1='';
		var $pregunta2='';
		var $pregunta3='';
		var $pregunta4='';
		var $pregunta5='';
		var $pregunta6='';
		var $pregunta7='';
		var $idEmpleadoMejor=0;
		var $comentarios=0;

		var $__s=array("idEncuesta","idVisita","realizada","fecha_realizacion","pregunta1","pregunta2","pregunta3","pregunta4","pregunta5","pregunta6","pregunta7","idEmpleadoMejor","comentarios");
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

		
		public function setIdEncuesta($idEncuesta)
		{
			if($idEncuesta==0||$idEncuesta==""||!is_numeric($idEncuesta)|| (is_string($idEncuesta)&&!ctype_digit($idEncuesta)))return $this->setError("Tipo de dato incorrecto para idEncuesta.");
			$this->idEncuesta=$idEncuesta;
			$this->getDatos();
		}
		public function setIdVisita($idVisita)
		{
			
			$this->idVisita=$idVisita;
		}
		public function setRealizada()
		{
			$this->realizada=1;
		}
		public function setFecha_realizacion($fecha_realizacion)
		{
			$this->fecha_realizacion=$fecha_realizacion;
		}
		public function setPregunta1($pregunta1)
		{
			$this->pregunta1=$pregunta1;
		}
		public function setPregunta2($pregunta2)
		{
			$this->pregunta2=$pregunta2;
		}
		public function setPregunta3($pregunta3)
		{
			$this->pregunta3=$pregunta3;
		}
		public function setPregunta4($pregunta4)
		{
			$this->pregunta4=$pregunta4;
		}
		public function setPregunta5($pregunta5)
		{
			$this->pregunta5=$pregunta5;
		}
		public function setPregunta6($pregunta6)
		{
			$this->pregunta6=$pregunta6;
		}
		public function setPregunta7($pregunta7)
		{
			$this->pregunta7=$pregunta7;
		}
		public function setIdEmpleadoMejor($idEmpleadoMejor)
		{
			
			$this->idEmpleadoMejor=$idEmpleadoMejor;
		}
		public function setComentarios($comentarios)
		{
			
			$this->comentarios=$comentarios;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetRealizada()
		{
			$this->realizada=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEncuesta()
		{
			return $this->idEncuesta;
		}
		public function getIdVisita()
		{
			return $this->idVisita;
		}
		public function getRealizada()
		{
			return $this->realizada;
		}
		public function getFecha_realizacion()
		{
			return $this->fecha_realizacion;
		}
		public function getPregunta1()
		{
			return $this->pregunta1;
		}
		public function getPregunta2()
		{
			return $this->pregunta2;
		}
		public function getPregunta3()
		{
			return $this->pregunta3;
		}
		public function getPregunta4()
		{
			return $this->pregunta4;
		}
		public function getPregunta5()
		{
			return $this->pregunta5;
		}
		public function getPregunta6()
		{
			return $this->pregunta6;
		}
		public function getPregunta7()
		{
			return $this->pregunta7;
		}
		public function getIdEmpleadoMejor()
		{
			return $this->idEmpleadoMejor;
		}
		public function getComentarios()
		{
			return $this->comentarios;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEncuesta=0;
			$this->idVisita=0;
			$this->realizada='';
			$this->fecha_realizacion='';
			$this->pregunta1='';
			$this->pregunta2='';
			$this->pregunta3='';
			$this->pregunta4='';
			$this->pregunta5='';
			$this->pregunta6='';
			$this->pregunta7='';
			$this->idEmpleadoMejor=0;
			$this->comentarios=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO encuesta(idVisita,realizada,fecha_realizacion,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6,pregunta7,idEmpleadoMejor,comentarios)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idVisita) . "','" . mysqli_real_escape_string($this->dbLink,$this->realizada) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_realizacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta1) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta2) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta3) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta4) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta5) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta6) . "','" . mysqli_real_escape_string($this->dbLink,$this->pregunta7) . "','" . mysqli_real_escape_string($this->dbLink,$this->idEmpleadoMejor) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "')";
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result){
					
					$this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEncuesta::Insertar]");
					return array('error'=>$this->getStrSystemError());
				}
				$this->idEncuesta=mysqli_insert_id($this->dbLink);
				return array('idEncuesta'=>$this->idEncuesta);
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
				$SQL="UPDATE encuesta SET idVisita='" . mysqli_real_escape_string($this->dbLink,$this->idVisita) . "',realizada='" . mysqli_real_escape_string($this->dbLink,$this->realizada) . "',fecha_realizacion='" . mysqli_real_escape_string($this->dbLink,$this->fecha_realizacion) . "',pregunta1='" . mysqli_real_escape_string($this->dbLink,$this->pregunta1) . "',pregunta2='" . mysqli_real_escape_string($this->dbLink,$this->pregunta2) . "',pregunta3='" . mysqli_real_escape_string($this->dbLink,$this->pregunta3) . "',pregunta4='" . mysqli_real_escape_string($this->dbLink,$this->pregunta4) . "',pregunta5='" . mysqli_real_escape_string($this->dbLink,$this->pregunta5) . "',pregunta6='" . mysqli_real_escape_string($this->dbLink,$this->pregunta6) . "',pregunta7='" . mysqli_real_escape_string($this->dbLink,$this->pregunta7) . "',idEmpleadoMejor='" . mysqli_real_escape_string($this->dbLink,$this->idEmpleadoMejor) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "'
					WHERE idEncuesta=" . $this->idEncuesta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEncuesta::Update]");
				
				return array('actualizacion'=>true);
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
				$SQL="DELETE FROM encuesta
				WHERE idEncuesta=" . mysqli_real_escape_string($this->dbLink,$this->idEncuesta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEncuesta::Borrar]");
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
						idEncuesta,idVisita,realizada,fecha_realizacion,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6,pregunta7,idEmpleadoMejor,comentarios
					FROM encuesta
					WHERE idEncuesta=" . mysqli_real_escape_string($this->dbLink,$this->idEncuesta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEncuesta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEncuesta==0)
				return $this->Insertar();
			else
				return $this->Actualizar();
			/*if($this->getError())
				return false;
			return true;*/
		}
		
	}

?>