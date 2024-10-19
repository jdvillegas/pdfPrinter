<?php 

$url = 'http://localhost/pdfPrinter/public/index.php';
$data = [
    'archivo'=> array('app_name'=>'capacitaciones', 
                      'tipo'=>'actas_capacitaciones', 
                      'id'=>1),
    'titulo' => 'Informe de ventas',
    'usuario' => 'Juan Perez',
    
    
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