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
			array('idEncuesta'=>'32',
			'idVisita' =>'36',
			'realizada'=>'1',
			
			'pregunta1'=>'3',
			'pregunta2'=>'4',
			'pregunta3'=>'5',
			'pregunta4'=>'2',
			'pregunta5'=>'33',
			'pregunta6'=>'4',
			'pregunta7'=>'15',
			'idEmpleadoMejor'=>'1',
			'comentarios' => 'sin comentarios'



			
				))
    ]*/
	
	//getEncuesta
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getEncuesta','parametros'=>json_encode(
			array('dato'=>'alexandermaydorga@outlook.co'//alexandermaydorga@outlook.com  492103093
				))
    ]
	
	/*
	//getEncuestaByCorreo
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

	/*
	//getEncuestaByCorreo
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getServicios','parametros'=>json_encode(
			array('correo_electronico'=>'asd'
				))
    ]*/

	
	/*//guardarVisita
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarVisita','parametros'=>json_encode(
			array('idVisita'=>'0',
			'fecha' =>'2022-03-01',
			'idServicio'=>'2',
			
			'idCliente'=>'52',
			'acompanantes'=>'5',
			'informacionExtra'=>'sin info'
				))
    ]*/
]);

$resp = curl_exec($curl);
$resp = json_decode($resp,true);
var_dump($resp);
curl_close($curl);  