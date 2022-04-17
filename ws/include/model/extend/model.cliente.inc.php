<?php

	require FOLDER_MODEL_BASE . "model.base.cliente.inc.php";

	class ModeloCliente extends ModeloBaseCliente
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseCliente";

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
		
		
		
	public function obtenerClienteByCorreo($correo)
		{
			$query = "Select idCliente,nombre, apellido, telefono,correo_electronico, cve_estado,cve_municipio from cliente where correo_electronico ='".$correo."'";
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo = $row_inf;
				}
			}
			if(count($arreglo)>0)
				return $arreglo;
			
			return array('Error'=>'No hay datos para mostrar');
		}
		
		public function obtenerClienteByTelefono($telefono)
		{
			$query = "Select idCliente,nombre, apellido, telefono,correo_electronico, cve_estado,cve_municipio from cliente where telefono ='".$telefono."'";
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo = $row_inf;
				}
			}
			if(count($arreglo)>0)
				return $arreglo;
			
			return array('Error'=>'No hay datos para mostrar');
		}
		
		public function obtenerCliente($dato)
		{
			$query = "Select idCliente from cliente where ";
			if (is_numeric($dato))
			{
				$query .=" telefono = '" . $dato."'";
				
			}
			else{
				
				$query.= " correo_electronico ='".$dato."'";
			}
			//return array('query'=>$query);
			$arreglo = array();
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo = $row_inf;
				}
			}
			if(count($arreglo)>0)
				return $arreglo;
			
			return array('error'=>'No hay datos para mostrar');
		}
		
		public function buscarCliente($dato)
		{
		    $query = "Select idCliente from cliente where ";
		    if (is_numeric($dato))
		    {
		        $query .=" telefono = '" . $dato."'";
		        
		    }
		    else{
		        $query.= " correo_electronico ='".$dato."'";
		    }
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        return true;
		    }
		        
		        return false;
		}
		
		public function existeCliente($idCliente)
		{
		    $query = "Select * from cliente where idCliente=$idCliente";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo = $row_inf;
		        }
		    }
		    if(count($arreglo)>0)
		        return $arreglo;
		        
		        return array('error'=>'No hay datos para mostrar');
		}
		
		
		
		public function guardarDatos($parametros)
		{
			//$datos = array('nombre' =>$parametros['nombre']);
		    $this->setNombre($parametros['nombre']);
			$this->setApellido($parametros['apellido']);
			$this->setTelefono($parametros['telefono']);
			$this->setCorreo_electronico($parametros['correo_electronico']);
			$this->setCve_estado($parametros['cve_estado']);
			$this->setCve_municipio($parametros['cve_municipio']);
			$this->setFecha_registro(date('Y-m-d H:i:s'));
			
			$arr = $this->buscarCliente($parametros['correo_electronico']);
			if($arr)
			    return array('error'=>"El correo ya est&aacute; registrado ".json_encode($arr));
			
			$arr = $this->buscarCliente($parametros['telefono']);
			if($arr)
				return array('error'=>"El tel&eacute;fono ya est&aacute; registrado");
			
			return $this->Guardar();
			//return $parametros;
				/*return $this->obtenerCliente($parametros['correo_electronico']);
			if(count($this->obtenerCliente($parametros['correo_electronico']))>0)
				return array('error'=>"El correo ya est&aacute; registrado");
			switch($parametros['telefono'])
			{
				
				case "":
					return $this->Guardar();
				break;
				
				default:
				if(count($this->obtenerClienteByTelefono($parametros['telefono']))>0)
					return array('error'=>"El tel&eacute;fono ya est&aacute; registrado");
				else
					
				break;
			}*/
			
			
		}
		
		public function getClientesByEstado($cve_estado)
		{
			$query = "Select idCliente,nombre,apellido,telefono,correo_electronico,cve_estado,cve_municipio,fecha_registro 
			from cliente where cve_estado=".$cve_estado;
			$arreglo = array();
			$contador=0;
			$resultado = mysqli_query($this->dbLink, $query);
			if ($resultado && mysqli_num_rows($resultado) > 0) {
				while ($row_inf = mysqli_fetch_assoc($resultado)){
					$arreglo[$contador] = $row_inf;
					$contador++;
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

