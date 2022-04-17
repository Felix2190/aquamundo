<?php

	require FOLDER_MODEL_BASE . "model.base.encuesta.inc.php";

	class ModeloEncuesta extends ModeloBaseEncuesta
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseEncuesta";

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
		public function guardarDatos($parametros)
		{
			//$datos = array('nombre' =>$parametros['idEncuesta']);
			$this->setIdEncuesta($parametros['idEncuesta']);
			$this->setIdVisita($parametros['idVisita']);
			$this->setRealizada($parametros['realizada']);
			$this->setFecha_realizacion(date('Y-m-d H:i:s'));
			$this->setPregunta1($parametros['pregunta1']);	
			$this->setPregunta2($parametros['pregunta2']);	
			$this->setPregunta3($parametros['pregunta3']);	
			$this->setPregunta4($parametros['pregunta4']);	
			$this->setPregunta5($parametros['pregunta5']);	
			$this->setPregunta6($parametros['pregunta6']);	
			$this->setPregunta7($parametros['pregunta7']);	
			$this->setIdEmpleadoMejor($parametros['idEmpleadoMejor']);
			$this->setComentarios($parametros['comentarios']);
			return $this->Guardar();
			//return array('e'=> getFirstEncuestaByIdCliente(52));
		}
		
		public function getFirstEncuestaByIdCliente($idCliente)
		{
			$query = "SELECT e.*,getFotoEmpleado(e.idEmpleadoMejor) as URL FROM visita v INNER JOIN encuesta e ON v.idVisita = e.idVisita and e.realizada = 0 WHERE v.idCliente =".$idCliente." ORDER BY v.fecha ASC LIMIT 1";
			//return array('e'=>'ca');
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo = $row_inf;
				}
			}
			return $arreglo;
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

