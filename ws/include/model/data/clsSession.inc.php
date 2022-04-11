<?php
//CLASE PARA CONTROLAR LA SESIÓN DE UN USUARIO
class clsSession 
{
	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	// en esta clase se declaran variables con el mismo nombre de las keys del array obtenido en login
	private $user_name;
	private $email;
	private $userName; // <--
	private $idRol; // <--
	private $nombre;
	private $idSucursal; // <--
	private $idUsuario;
	private $apellidos;
	private $correo;
	private $sucursal; // <--
	private $tipoUsuario;
	private $lugar;
	private $estilo_css;
	private $campo;
	private $rol;
	private $empresa;
	private $foto;
	private $nombreCompleto;
	
		
	
	public $_lastTime;
	public $_lastTimeSoporte;


	public $_ejecucionPendiente=array();

	private $_data=array();

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#--------------------------------------------Control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------#
	//también se agregan en un array
	var $__s=array(	"userName",	"idUsuario","nombre","apellidos","tipoUsuario","sucursal","lugar","correo","idRol", "idSucursal","estilo_css","campo","rol","empresa","foto","nombreCompleto");

	public function __construct()
	{

	}


	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#----------------------------------------Setter Getter------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function setData($k,$v)
	{
		$this->_data[$k]=$v;
	}

	public function getData($k)
	{
		return $this->_data[$k];
	}

	public function getUserName()
	{
		return $this->userName;
	}

	public function getCorreo()
	{
		return $this->correo;
	}
	
	public function getNombre()
	{
	    return $this->nombre;
	}
	
	public function getApellidos()
	{
	    return $this->apellidos;
	}
	
	public function getidUsuario()
	{
	    return $this->idUsuario;
	}
	
	public function getSucursal()
	{
	    return $this->sucursal;
	}
	
	public function getIdSucursal()
	{
	    return $this->idSucursal;
	}
	
	public function getLugar()
	{
	    return $this->lugar;
	}
		
	public function getTipoUsuario()
	{
	    return $this->tipoUsuario;
	}
	
	public function getidRol()
	{
	    return $this->idRol;
	}
	
	public function getRol()
	{
	    return $this->rol;
	}
	public function getestilo_css()
	{
	    return $this->estilo_css;
	}
		public function getcampo()
	{
	    return $this->campo;
	}
	public function getEmpresa()
	{
	    return $this->empresa;
	}
		public function getFoto()
	{
	    return $this->foto;
	}
	
	public function isSessionActive()
	{
		return time()-$this->_lastTime<defined("SESSION_TIME")?SESSION_TIME:1800;
	}

	public function updateTime()
	{
		$this->_lastTime=time();
	}

	public function getNombreCompleto()
	{
	    return $this->nombreCompleto;
	}
	
	public function setObjetoGetInfo($oGI)
	{
		/*
		 * la función del foreach es recorrer cada key del array recibido,
		 * después verifica que esté dentro del array __s,
		 * si esta, setea la variable de la clase con el valor de la key (linea 142)
		 * */
		foreach($oGI as $k=>$v)
		{
			if(in_array($k, $this->__s))
			{
				$this->$k=$v;
				// $this->userName= valor $v
				// $this->idRol= valor $v
				// ...
			}
		}

	}


	public function resetError()
	{
		$this->error=false;
		$this->strError="";
	}


	
	public function setSucursal($sucursal)
	{
	    $this->sucursal=$sucursal;
	}
	public function setIdSucursal($idSucursal)
	{
	    $this->idSucursal=$idSucursal;
	}
	public function setLugar($lugar)
	{
	    $this->lugar=$lugar;
	}
	public function setUserName($username)
	{
	    $this->userName=$username;
	}
	public function setCorreo($correo)
	{
	    $this->correo=$correo;
	}
	
	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#
} ?>