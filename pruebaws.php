<?php
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
   
//  CURLOPT_URL => 'http://localhost/aquamundo/ws/.php',
/*    
    CURLOPT_POSTFIELDS => [
        'token'=>'','parametros'=>json_encode(array(
        'username' => 'prueba012',
        'password' => 'prueba')), 'accion'=>'iniciar'
    ]

*/
    CURLOPT_URL => 'http://localhost/aquamundo/ws/combosws.php',
    
    CURLOPT_POSTFIELDS => [
        'token'=>'c0b65970aaadafc39f0a3b8f8d9d498be56c1e70',
        'accion'=>'inegimunicipios','parametros'=>json_encode(array('cve_estado'=>'17'))
    ]
    
    
]);

$resp = curl_exec($curl);
$resp = json_decode($resp,true);
var_dump($resp);
curl_close($curl);  