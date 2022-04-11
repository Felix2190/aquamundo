<?php

	function respuestaError($msgError,$sesion=true)
	{
		$R=new clsWsRespuesta();
		$R->setRespuesta(false);
		$R->setMensaje($msgError);
		$R->setSesion($sesion);
		die($R->getJSONRespuesta());
	}
	

	class clsWsRespuesta 
	{
		var $respuesta;
		var $mensaje="";
		var $datos="";
		var $sesion=true;
		
		public function setRespuesta($result)
		{
			$this->respuesta=$result;
		}
		public function setMensaje($msg)
		{
			$this->mensaje=$msg;
		}
		
		public function setDatos($data)
		{
			$this->datos=$data;
		}
		
		public function setSesion($sesion)
		{
		    $this->sesion=$sesion;
		}
		
		public function getJSONRespuesta()
		{
		    $r=array("respuesta"=>$this->respuesta,"sesion"=>$this->sesion,"mensaje"=>$this->mensaje,"datos"=>$this->datos);
			return json_encode($r);
		}
		
	}

	class clsAppGenericProcess
	{
		var $token;
		var $param;
		
		
		public function setParam($param)
		{
			$Parametros=json_decode($param);
			foreach($Parametros AS $variable=>$valor)
				$this->$variable=$valor;
		}
		
		
		
	}