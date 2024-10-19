<?php 

$url = 'http://localhost/andipdfPrinter/public/index.php';
$data = [
    'titulo' => 'Informe de ventas',
    'usuario' => 'Juan Perez',
    'tipo'=> 'actas_capacitaciones',
    
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n" .
                     "Authorization: Bearer TOKEN1\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);

var_dump($response); 

?>