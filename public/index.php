<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar variables de entorno del archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\PdfService;

// Obtener los valores del archivo .env
$pdfBaseUrl = $_ENV['PDF_BASE_URL'];  // URL base para PDFs
$authorizedTokens = explode(',', $_ENV['AUTHORIZED_TOKENS']);  // Listado de tokens autorizados
$jwtSecretKey = $_ENV['JWT_SECRET_KEY'];  // Clave secreta para JWT

// **AGREGAR LOG**: Registrar solicitud entrante
$logFile = __DIR__ . '/../logs/pdf_log.txt';
file_put_contents($logFile, "Solicitud entrante: " . $_SERVER['REQUEST_METHOD'] . " - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

// Verificar el metodo de la solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    file_put_contents($logFile, "Error: Metodo no permitido\n", FILE_APPEND);  // Log para error
    http_response_code(405);
    echo json_encode(['error' => 'Metodo no permitido']);
    exit;
}

// Obtener el token de los encabezados de la solicitud
$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

// Definir la ruta del directorio de PDFs
$pdfDir = __DIR__ . '/../pdfs';

// Verificar si el directorio existe, si no, crearlo
if (!is_dir($pdfDir)) {
    mkdir($pdfDir, 0777, true);
}

// Verificar si el token este autorizado
if (!in_array($token, $authorizedTokens)) {
    file_put_contents($logFile, "Error: Token no autorizado\n", FILE_APPEND);
    http_response_code(403);
    echo json_encode(['error' => 'Acceso denegado: Token no autorizado']);
    exit;
}

// Obtener los datos de la solicitud (en JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['titulo']) || !isset($data['usuario'])) {
    file_put_contents($logFile, "Error: Datos incompletos\n", FILE_APPEND);
    http_response_code(400);
    echo json_encode(['error' => 'Datos incompletos']);
    exit;
}

// Generar el PDF
$pdfService = new PdfService();
$fileName = $pdfService->generarPDF($data);

// Registrar PDF generado y devuelto
file_put_contents($logFile, "PDF generado y devuelto: " . $fileName . " - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

// Devolver la ruta del archivo generado
http_response_code(200);
echo json_encode([
    'status' => 'success',
    'pdf_url' => $pdfBaseUrl . $fileName
]);
