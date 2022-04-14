<?php
$pedazos = explode("/", $_SERVER['PHP_SELF']);
$__FILE_NAME__ = str_replace(array("/",".php"), "", $pedazos[count($pedazos) - 1]);
$minutosSesion=30;
$tiempoSegSesion=$minutosSesion*60;
$array=array("");
$arrayPrincipal=array("listado","nuevo","buscar","detalle");
$arrayRol=array("listado","nuevo");
$arrayCompraVenta=array("buscar","detalle");
$arrayParametros=array("buscar","detalle","nuevo","iniciar");
$arrayParametrosInegi=array("inegimunicipios","inegilocalidades");
$arrayCombos=array("empresasprov","inegiestados","inegimunicipios","inegilocalidades","sucursales","roles","tipoarticulos","usuarios","categorias","obtenerClienteByCorreo","guardarCliente","obtenerClienteByTelefono","obtenerClienteByEstado","guardarEncuesta","guardarVisitaCliente","getEncuestaByTelefono","getEncuestaByCorreo","getServicios");
switch ($__FILE_NAME__) {
    case "loginws":
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if ($_POST['accion'] != "iniciar" && $_POST['accion'] != "cerrar")
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros ");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "iniciar") {
            if (! isset($parametros['username']) || $parametros['username'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro username ");
            if (! isset($parametros['password']) || $parametros['password'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro password");
        }
        if ($_POST['accion'] == "cerrar") {
            if (! isset($_POST['token']) || $_POST['token'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro token");
        }
        break;
    case "usuariows":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayPrincipal))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros ".$_POST['parametros']);
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
        }
        if ($_POST['accion'] == "nuevo") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['apaterno']) || $parametros['apaterno'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro apaterno");
            if (! isset($parametros['amaterno']) || $parametros['amaterno'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro amaterno");
            if (! isset($parametros['direccion']) || $parametros['direccion'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro direccion");
            if (! isset($parametros['correo']) || $parametros['correo'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro correo");
            if (! isset($parametros['username']) || $parametros['username'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro username");
            if (! isset($parametros['idRol']) || $parametros['idRol'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro idRol");
            if (! isset($parametros['idSucursal']) || $parametros['idSucursal'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro idSucursal");
        }
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    
    case "proveedoresws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayPrincipal))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['nombre']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['idEmpresa']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro idEmpresa");
            if (! isset($parametros['estatus']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro estatus");
            if ($parametros['nombre'] == "" || $parametros['idEmpresa'] == "" )
                respuestaError("Error... debe ingresar al menos un par&aacute;metro a buscar");
        }
        if ($_POST['accion'] == "nuevo") {
            if (! isset($parametros['idEmpresa']) || $parametros['idEmpresa'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro idEmpresa");
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['apellidos']) || $parametros['apellidos'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro apellidos");
            if (! isset($parametros['correo']) || $parametros['correo'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro correo");
            if (! isset($parametros['telefono']) || $parametros['telefono'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro telefono");
        }
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    
    case "empresasws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayPrincipal))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
        }
        if ($_POST['accion'] == "nuevo") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['rfc']) || $parametros['rfc'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro rfc");
            if (! isset($parametros['razon_social']) || $parametros['razon_social'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro razon_social");
            if (! isset($parametros['correo']) || $parametros['correo'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro correo");
            if (! isset($parametros['estado_id']) || $parametros['estado_id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro estado_id");
            if (! isset($parametros['municipio_id']) || $parametros['municipio_id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro municipio_id");
            if (! isset($parametros['localidad_id']) || $parametros['localidad_id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro localidad_id");
  /*          if (! isset($parametros['codigo_postal']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro codigo_postal");
            if (! isset($parametros['calle']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro calle");
            if (! isset($parametros['colonia']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro colonia");
            if (! isset($parametros['num_interior']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro num_interior");
            if (! isset($parametros['num_exterior']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro num_exterior");  */
        }
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    case "articulosws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayPrincipal))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
        }
        if ($_POST['accion'] == "nuevo") {
            if (! isset($parametros['fccodigo_barra']) && ! isset($parametros['fcclave']) && ! isset($parametros['fcmodelo']))
                respuestaError("Error... debe estar definido algun par&aacute;metro (c&oacute;digo, clave, modelo)");
            if (isset($parametros['fccodigo_barra']))
                if ($parametros['fccodigo_barra'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro codigo_barra");
            if (isset($parametros['fcclave']))
                if ($parametros['fcclave'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro clave");
            if (isset($parametros['fccmodelo']))
                if ($parametros['fcmodelo'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro modelo");
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['tipo_articulo']) || $parametros['tipo_articulo'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro tipo_articulo");
            if (! isset($parametros['descripcion']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro descripcion");
            if (! isset($parametros['categoria']) || $parametros['categoria'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro categoria");
        }
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    case "rolesws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (in_array($_POST['accion'], $arrayParametros)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if (! in_array($_POST['accion'], $arrayRol))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if ($_POST['accion'] == "nuevo") {
            if (! isset($parametros['nombre']) || $parametros['nombre'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
            if (! isset($parametros['descripcion']) || $parametros['descripcion'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro descripcion");
        }
        break;
    
    case "comprasws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayCompraVenta))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayCompraVenta)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['fechaInicio']) || $parametros['fechaInicio'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro fechaInicio");
            if (! isset($parametros['fechaFin']) || $parametros['fechaFin'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro fechaFin");
            if (! isset($parametros['sucursal']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro sucursal");
        }
        
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    case "ventasws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayCompraVenta))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayCompraVenta)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "buscar") {
            if (! isset($parametros['fechaInicio']) || $parametros['fechaInicio'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro fechaInicio");
            if (! isset($parametros['fechaFin']) || $parametros['fechaFin'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro fechaFin");
            if (! isset($parametros['sucursal']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro sucursal");
            if (! isset($parametros['usuario']))
                respuestaError("Error... no est&aacute; definido el par&aacute;metro usuario");
        }
        
        if ($_POST['accion'] == "detalle") {
            if (! isset($parametros['id']) || $parametros['id'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro id");
        }
        break;
    
    case "combosws":
        if (! isset($_POST['token']) || $_POST['token'] == "")
            respuestaError("Error ... no est&aacute; definido el par&aacute;metro token");
        if (! isset($_POST['accion']) || $_POST['accion'] == "")
            respuestaError("Error... no est&aacute; definido el par&aacute;metro acci&oacute;n");
        if (! in_array($_POST['accion'], $arrayCombos))
            respuestaError("Error... acci&oacute;n inv&aacute;lida");
        if (in_array($_POST['accion'], $arrayParametrosInegi)) {
            if (! isset($_POST['parametros']) || $_POST['parametros'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro parametros");
            $parametros = json_decode($_POST['parametros'], true);
        }
        if ($_POST['accion'] == "inegimunicipios") {
            if (! isset($parametros['cve_estado']) || $parametros['cve_estado'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_estado");
        }
        if ($_POST['accion'] == "inegilocalidades") {
            if (! isset($parametros['cve_estado']) || $parametros['cve_estado'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_estado");
            if (! isset($parametros['cve_municipio']) || $parametros['cve_municipio'] == "")
                respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_municipio");
        }
        if ($_POST['accion'] == "usuarios" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['sucursal']))
                if ($parametros['sucursal'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro sucursal");
        }
		
		if ($_POST['accion'] == "obtenerClienteByCorreo" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['correo_electronico']))
                if ($parametros['correo_electronico'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro correo_electronico");
        }
		
		if ($_POST['accion'] == "obtenerClienteByTelefono" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['telefono']))
                if ($parametros['telefono'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro telefono");
        }
		
		if ($_POST['accion'] == "guardarCliente" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['idCliente']))
                if ($parametros['idCliente'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idCliente");
			if (isset($parametros['nombre']))
                if ($parametros['nombre'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro nombre");
			if (isset($parametros['apellido']))
                if ($parametros['apellido'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro apellido");
			
			if (isset($parametros['correo_electronico']))
                if ($parametros['correo_electronico'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro correo_electronico");
			if (isset($parametros['cve_estado']))
                if ($parametros['cve_estado'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_estado");
			if (isset($parametros['cve_municipio']))
                if ($parametros['cve_municipio'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_municipio");
			
				
        }
		
		if ($_POST['accion'] == "obtenerClienteByEstado" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['cve_estado']))
                if ($parametros['cve_estado'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro cve_estado");
        }
		
		
		if ($_POST['accion'] == "guardarEncuesta" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['idEncuesta']))
                if ($parametros['idEncuesta'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idEncuesta");
			if (isset($parametros['idVisita']))
                if ($parametros['idVisita'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idVisita");
			if (isset($parametros['realizada']))
                if ($parametros['realizada'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro realizada");
			if (isset($parametros['fecha_realizacion']))
                if ($parametros['fecha_realizacion'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro fecha_realizacion");
			if (isset($parametros['pregunta1']))
                if ($parametros['pregunta1'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta1");
			if (isset($parametros['pregunta2']))
                if ($parametros['pregunta2'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta2");
			if (isset($parametros['pregunta3']))
                if ($parametros['pregunta3'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta3");
			if (isset($parametros['pregunta4']))
                if ($parametros['pregunta4'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta4");	
			if (isset($parametros['pregunta5']))
                if ($parametros['pregunta5'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta5");	
			if (isset($parametros['pregunta6']))
                if ($parametros['pregunta6'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta6");
			if (isset($parametros['pregunta7']))
                if ($parametros['pregunta7'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro pregunta7");
				
			
			if (isset($parametros['idEmpleadoMejor']))
                if ($parametros['idEmpleadoMejor'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idEmpleadoMejor");
			if (isset($parametros['comentarios']))
                if ($parametros['comentarios'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro comentarios");

			
        }
		
		
		if ($_POST['accion'] == "guardarVisitaCliente" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['idVisita']))
                if ($parametros['idVisita'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idVisita");
			if (isset($parametros['fecha']))
                if ($parametros['fecha'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro fecha");
			if (isset($parametros['idServicio']))
                if ($parametros['idServicio'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idServicio");
			if (isset($parametros['idCliente']))
                if ($parametros['idCliente'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro idCliente");
        }
		
		
		if ($_POST['accion'] == "getEncuestaByCorreo" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['correo_electronico']))
                if ($parametros['correo_electronico'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro correo_electronico");
        }
		
		if ($_POST['accion'] == "getEncuestaByTelefono" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['telefono']))
                if ($parametros['telefono'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro telefono");
        }
		
		if ($_POST['accion'] == "getServicios" && isset($_POST['parametros'])) {
            $parametros = json_decode($_POST['parametros'], true);
            if (isset($parametros['correo_electronico']))
                if ($parametros['correo_electronico'] == "")
                    respuestaError("Error... no est&aacute; definido el par&aacute;metro telefono");
        }
		
        break;
}
