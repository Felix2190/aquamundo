<?php

	require FOLDER_MODEL_BASE . "model.base.inegidomgeo_cat_municipio.inc.php";

	class ModeloInegidomgeo_cat_municipio extends ModeloBaseInegidomgeo_cat_municipio
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseInegidomgeo_cat_municipio";

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
		public function obtenerMunicipios()
		{
			$query = "Select CVE_MUN, NOM_MUN from inegidomgeo_cat_municipio ";
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo[$row_inf['CVE_MUN']] = $row_inf['NOM_MUN'];
				}
			}
			return $arreglo;
		}
		public function obtenerMunicipioById($CVE_ENT,$CVE_MUN)
		{
			$query = "Select CVE_MUN, NOM_MUN from inegidomgeo_cat_municipio where CVE_ENT=".$CVE_ENT." and CVE_MUN=".$CVE_MUN;
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo = $row_inf;
				}
			}
			return $arreglo;
		}
		public function validarDatos()
		{
			return true;
		}
		function Imprime( $data ) {
		    $output = $data;
		    if ( is_array( $output ) )
		        $output = implode( ',', $output);

		    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
		}
public function obtenerMunicipioXestado($CVE_ENT)
		{
			$query = "Select CVE_MUN, NOM_MUN from inegidomgeo_cat_municipio where CVE_ENT=".$CVE_ENT;
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo[$row_inf['CVE_MUN']] = $row_inf['NOM_MUN'];
				}
			}
			return $arreglo;
		}

	}
