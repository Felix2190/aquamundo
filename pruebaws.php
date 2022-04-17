<?php
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
   
//  CURLOPT_URL => 'http://localhost/aquamundo/ws/combosws2.php',
 /*   
    CURLOPT_POSTFIELDS => [
        'token'=>'','parametros'=>json_encode(array(
        'username' => 'Admin',
        'password' => 'usuario123')), 'accion'=>'iniciar'
    ],

*/
    CURLOPT_URL => 'http://aquamundo.misointec.com.mx/ws/combosws.php',
    /*
    CURLOPT_POSTFIELDS => [
*/
  //  CURLOPT_URL => 'http://localhost/aquamundo/ws/clientews.php',
    
    /*CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'inegimunicipios','parametros'=>json_encode(array('cve_estado'=>'01'))
    ]
	
	/
	 
	 
	 //obtenerCliente
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerCliente','parametros'=>json_encode(
			array('dato'=>'7331258053'
				))
    ]
	
	//guardarCliente
	/*
    CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarCliente','parametros'=>json_encode(
			array(
			'nombre' =>'Fati',
			'apellido'=>'Ortiz',
			'telefono'=>'7331258003',
			'correo_electronico'=>'fati@gmail.com',
			'cve_estado' => '32',
			'cve_municipio'=>'048'
				))
    ]
    */
    
	/*//obtenerClientesByEstado
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerClienteByEstado','parametros'=>json_encode(
			array('cve_estado'=>'31'
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
	
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getServicios'
    ]
    
	/*
	//getEncuestaByCorreo
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getServicios','parametros'=>json_encode(
			array('correo_electronico'=>'asd'
				))
    ]*/
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