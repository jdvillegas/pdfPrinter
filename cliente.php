<?php 

/**
 * @OA\Post(
 *     path="/pdfPrinter/public/index.php",
 *     summary="Enviar datos y obtener una respuesta",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="archivo", type="object",
 *                 @OA\Property(property="app_name", type="string", example="capacitaciones"),
 *                 @OA\Property(property="tipo", type="string", example="actas_capacitaciones"),
 *                 @OA\Property(property="template", type="string", example="acta_capacitacion"),
 *                 @OA\Property(property="cliente_id", type="integer", example=0),
 *                 @OA\Property(property="id", type="integer", example=1)
 *             ),
 *             @OA\Property(property="titulo", type="string", example="Informe de ventas"),
 *             @OA\Property(property="usuario", type="string", example="Juan Perez")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Respuesta exitosa",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     )
 * )
 */

$url = 'http://localhost/pdfPrinter/public/index.php';
$data = [
    'archivo'=> array('app_name'=>'capacitaciones', 
                      'tipo'=>'actas_capacitaciones',
                      'template'=>'acta_capacitacion',
                      'cliente_id'=>0, //  Si el cliente_id es 0, se toma el template por defecto
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