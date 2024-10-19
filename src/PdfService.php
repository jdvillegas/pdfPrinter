<?php
namespace App;

use Mpdf\Mpdf;

class PdfService {
    public function generarPDF($data) {
        $mpdf = new Mpdf();
        
        // Crear contenido del PDF
        $htmlContent = '<h1>Reporte de ' . htmlspecialchars($data['titulo']) . '</h1>';
        $htmlContent .= '<p>Generado para: ' . htmlspecialchars($data['usuario']) . '</p>';
        
        $mpdf->WriteHTML($htmlContent);

        // Nombre y ruta del archivo PDF
        $fileName = 'reporte_' . time() . '.pdf';
        $filePath = __DIR__ . '/../pdfs/' . $fileName;

        // Verificar si el directorio 'pdfs' existe, si no, crearlo
        $pdfDir = __DIR__ . '/../pdfs';
        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0777, true);
        }

        // Guardar el PDF en el sistema de archivos
        $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

        // **AGREGAR LOG**: Registrar que el PDF fue generado
        $logFile = __DIR__ . '/../logs/pdf_log.txt';
        file_put_contents($logFile, "PDF generado: " . $fileName . " - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

        return $fileName;
    }
}
