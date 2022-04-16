<?php
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
   
//  CURLOPT_URL => 'http://localhost/aquamundo/ws/combosws2.php',
    
    CURLOPT_POSTFIELDS => [
        'token'=>'','parametros'=>json_encode(array(
        'username' => 'Admin',
        'password' => 'usuario123')), 'accion'=>'iniciar'
    ],


    CURLOPT_URL => 'http://aquamundo.misointec.com.mx/ws/loginws.php',
    /*
    CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'inegimunicipios','parametros'=>json_encode(array('cve_estado'=>'01'))
    ]
	
	/* //obtenerClienteByCorreo
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerClienteByCorreo','parametros'=>json_encode(
			array('correo_electronico'=>'alex_va_28@hotmail.com'
				))
    ]*/
    
	/*//obtenerClienteByTelefono
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerClienteByTelefono','parametros'=>json_encode(
			array('telefono'=>'4921030923'
				))
    ]
	*/
	/*//guardarCliente
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarCliente','parametros'=>json_encode(
			array('idCliente'=>'0',
			'nombre' =>'David',
			'apellido'=>'Vicencio',
			'telefono'=>'492103093',
			'correo_electronico'=>'alexandermaydorga@outlook.com',
			'cve_estado' => '32',
			'cve_municipio'=>'048'
				))
    ]*/
    
	/*//obtenerClientesByEstado
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerClienteByEstado','parametros'=>json_encode(
			array('cve_estado'=>'32'
				))
    ]*/
	/*//guardarEncuesta
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarEncuesta','parametros'=>json_encode(
			array('idEncuesta'=>'0',
			'idVisita' =>'2',
			'realizada'=>'1',
			
			'pregunta1'=>'3',
			'pregunta2'=>'4',
			'pregunta3'=>'5',
			'pregunta4'=>'2',
			'pregunta5'=>'3',
			'pregunta6'=>'4',
			'pregunta7'=>'5',
			'idEmpleadoMejor'=>'1',
			'comentarios' => 'sin comentarios'



			
				))
    ]*/
	
	/*//getEncuestaByTelefono
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getEncuestaByTelefono','parametros'=>json_encode(
			array('telefono'=>'4921030923'
				))
    ]*/
	
	
	/*//getEncuestaByCorreo
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getEncuestaByCorreo','parametros'=>json_encode(
			array('correo_electronico'=>'alex_va_28@hotmail.com'
				))
    ]*/
	//getEncuestaByCorreo
	/*
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getServicios'
    ]
	/*
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarEncuesta','parametros'=>json_encode(
			array('idEncuesta'=>'0'
			
			
				))
    ]*/
]);

$resp = curl_exec($curl);
$resp = json_decode($resp,true);
var_dump($resp);
curl_close($curl);  