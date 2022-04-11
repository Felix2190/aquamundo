<?php
//CLASE PRINCIPAL
require_once CLASS_CONEXION;
$ConexionPrincipal = new ConexionBD();
class clsBasicCommon  
{
	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	var $error=false;
	var $strError="";
	var $warning=false;
	var $arrWarning=array();

	var $debug=false;
	var $debugFile=false;
	var $debugFileName="";

	var $strSystemError;

	var $dbLink;
	var $link;

	var $__s=array();

	protected $_arrayProcedureOUT=array();
	

	#-----------------------------------------------------------------------------------------------#
	#------------------------------------Constructor Destructor-------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function __construct()
	{
	    global $ConexionPrincipal;
	    if(is_null($ConexionPrincipal->getConexion()))
	    {
	        trigger_error("La coneccion a la base de datos no esta establecida.",E_USER_ERROR);
	        return;
	    }
	    $this->dbLink=$ConexionPrincipal->getConexion();
	    $this->link=$ConexionPrincipal->getConexion();
	    
	}
	


	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------Setter Getter-----------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function clearError()
	{
		$this->error=false;
		$this->strError="";
	}

	public function setError($msg)
	{
		$this->error=true;
		$this->strError=$msg;
		return false;
	}

	public function setSystemError($msg,$msgSystem)
	{
		$this->strSystemError=$msgSystem;
		return $this->setError($msg);

	}

	public function getError()
	{
		return $this->error;
	}

	public function getStrError()
	{
		if(defined("DEVELOPER")&&DEVELOPER)
			return $this->strError . ($this->strSystemError!=""?"::SYSERROR: " . $this->strSystemError : "");
		return $this->strError;
	}

	public function getStrSystemError()
	{
		return $this->strSystemError;
	}

	public function setWarning($msg)
	{
		$this->warning=true;
		$this->arrWarning[]=$msg;
	}

	public function getWarning()
	{
		return $this->warning;
	}
	public function getArrWarning()
	{
		return $this->arrWarning;
	}

	public function getStrWarning($s="<br />")
	{
		return implode($s,$this->arrWarning);
	}

	public function clearWarning()
	{
		$this->warning=false;
		$this->arrWarning=array();
	}

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------#
	#---------------------------------------------Otras---------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function toUpper()
	{
		foreach($this->__s as $k=>$v)
			$this->$v=strtoupper($this->$v);
	}


	public function transaccionIniciar()
	{
		if(function_exists("mysqli_begin_transaction"))
		{
			$r=mysqli_begin_transaction($this->dbLink);
		}
		else
		{
			$query="START TRANSACTION";
			$r=mysqli_query($this->dbLink, $query);
		}
		if(!$r)
			return $this->setSystemError("Error en la BD", mysql_error());
		return true;
	}

	public function transaccionCommit()
	{
		if(function_exists("mysqli_commit"))
		{
			$r=mysqli_commit($this->dbLink);
		}
		else
		{
			$query="COMMIT";
			$r=mysqli_query($this->dbLink, $query);
		}
		if(!$r)
			return $this->setSystemError("Error en la BD", mysql_error());
		return true;

	}

	public function transaccionRollback()
	{
		if(function_exists("mysqli_rollback"))
		{
			$r=mysqli_rollback($this->dbLink);
		}
		else
		{
			$query="ROLLBACK";
			$r=mysqli_query($this->dbLink, $query);
		}
		if(!$r)
			return $this->setSystemError("Error en la BD", mysql_error());
		return true;
	}




	public function Clonar($obj)
	{
		foreach($this->__s AS $k=>$v)
		{
			if(isset($obj->$v))
			{
				$this->$v=$obj->$v;
			}
		}


	}

	public function serialize()
	{
		$valores=array();
		foreach($this->__s AS $k=>$v)
		{
			$valores[$v]=$this->$v;
		}
		return serialize($valores);
	}

	public function unserialize($v)
	{

		$valores=unserialize($v);
		foreach($valores AS $k=>$v)
		{
			$this->$k=$v;
		}
	}

	public function getArrayProcedureOUT()
	{
	    return $this->_arrayProcedureOUT;
	}
	
	public function callProcedure($procedure,$varIN=array(),$varOUT=false){
	    $this->_arrayProcedureOUT=array();
	    if (!is_array($varIN)){
	        $this->error=true;
	        $this->strError="error, no es de tipo array la variable varIN";
	        return ;
	    }
	    if ($varOUT!=false&&!is_array($varOUT)){
	        $this->error=true;
	        $this->strError="error, no es de tipo array la variable varOUT";
	        return ;
	    }
	    // si no hay error
	    if (!$this->error){
	        $parametros="";
	        if (is_array($varOUT)&&count($varOUT)>0){
	            foreach ($varOUT as $var){
	                $this->dbLink->query("SET @$var=''");
	                $this->_arrayProcedureOUT[$var]="";
	            }
	            
	            $parametros="@".implode(",@",$varOUT);
	        }
	        
	        if (count($varIN)>0){
	            if ($parametros!="")
	                $parametros.=",";
	            $parametros.="'".implode("','",$varIN)."'";
	        }
	        
	        $res =$this->dbLink->query("call $procedure($parametros)");
	        if (!$res) {
	            $this->error=true;
	            $this->strError=$this->dbLink->error;
	            return ;
	        }
	        //var_dump($parametros);
	        if (is_array($varOUT)){ /// salida OUT
        	    foreach ($varOUT as $var){ 
	               if (!($res = $this->dbLink->query("SELECT @$var as salida"))) {
	                   $this->error=true;
	                   $this->strError=$this->dbLink->errno ;
	                   return ;
    	           }
        	           $row = $res->fetch_assoc();
        	           $this->_arrayProcedureOUT[$var]= $row['salida'];
        	           $res->free();
        	    }
	        }else {
    	            while ($row=$res->fetch_assoc())
        	            $this->_arrayProcedureOUT[]=$row;
    	            $res->free();
	            
	        }
	        
	    $this->dbLink->close();
	    global $ConexionPrincipal ;
	    $ConexionPrincipal = new ConexionBD();
	    $this->dbLink=$ConexionPrincipal->getConexion();
	    $this->link=$ConexionPrincipal->getConexion();
	    
	    
	    }
	}


}