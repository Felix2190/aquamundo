<?php
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
   
  CURLOPT_URL => 'http://localhost/aquamundo/ws/encuestaws.php',
 /*   
    CURLOPT_POSTFIELDS => [
        'token'=>'','parametros'=>json_encode(array(
        'username' => 'Admin',
        'password' => 'usuario123')), 'accion'=>'iniciar'
    ],
*/
/*
 //servicios
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getServicios'
    ]
    
    */
 /*
    CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'inegimunicipios','parametros'=>json_encode(array('cve_estado'=>'01'))
    ]
*/
	
 
 /*
	 //obtenerCliente
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerCliente','parametros'=>json_encode(
			array('dato'=>'7331258053'
				))
    ]
	*/
    
	//guardarCliente
	/*
    CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'guardarCliente','parametros'=>json_encode(
			array(
			'nombre' =>'Romulofe',
			'apellido'=>'Ortiz',
			'telefono'=>'7331258503',
			'correo_electronico'=>'romulo@gmail.com',
			'cve_estado' => '32',
			'cve_municipio'=>'048'
				))
    ]
    */
    
    /*
     //guardarVisita
     CURLOPT_POSTFIELDS => [
     'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
     'accion'=>'guardarVisita','parametros'=>json_encode(
     array(
      'idServicio'=>'1',
     'idCliente'=>'1',
     'acompanantes'=>'0',
     'informacionExtra'=>'sin info'
     ))
     ]
    */
    
/*
  
      //getEncuesta
     CURLOPT_POSTFIELDS => [
     'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
     'accion'=>'getEncuesta','parametros'=>json_encode(
     array('idCliente'=>'1'//alexandermaydorga@outlook.com  492103093
     ))
     ]
 */   

    
     //guardarEncuesta
     CURLOPT_POSTFIELDS => [
     'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
     'accion'=>'guardarEncuesta','parametros'=>json_encode(
     array('idEncuesta'=>'1',
     'pregunta1'=>'3',
     'pregunta2'=>'4',
     'pregunta3'=>'5',
     'pregunta4'=>'2',
     'pregunta5'=>'3',
     'pregunta6'=>'4',
     'pregunta7'=>'1',
     'idEmpleadoMejor'=>'3',
     'comentarios' => 'sin comentarios'
         
         
         
         
     ))
     ]
    
     /*
      * //obtenerClientesByEstado
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'obtenerClienteByEstado','parametros'=>json_encode(
			array('cve_estado'=>'31'
				))
    ]*/

    /*
	//getEncuestaByCorreo
	CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'getEncuestaByCorreo','parametros'=>json_encode(
			array('correo_electronico'=>'alex_va_28@hotmail.com'
				))
    ]*/
	//getEncuestaByCorreo
	
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

	
]);

$resp = curl_exec($curl);
$resp = json_decode($resp,true);
var_dump($resp);
curl_close($curl);  