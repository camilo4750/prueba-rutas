<?php
require_once BASE_PATH . '/config.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class RouteController
{
    public function index()
    {
        require_once BASE_PATH . '/views/index.php';
    }

    public function procesar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['excel'])) {
            header('Location: index.php');
            exit;
        }

        $archivo = $_FILES['excel'];

        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            header('Location: index.php');
            exit;
        }

        $nombreArchivo = uniqid() . '.xlsx';
        $rutaArchivo = UPLOAD_PATH . $nombreArchivo;
        move_uploaded_file($archivo['tmp_name'], $rutaArchivo);

        $spreadsheet = IOFactory::load($rutaArchivo);
        $datosExcel = $spreadsheet->getActiveSheet()->toArray();

        $datos = [];
        for ($i = 1; $i < count($datosExcel); $i++) {
            $fila = $datosExcel[$i];
            if (!empty($fila[0]) && !empty($fila[3])) {
                $datos[] = [
                    'guia' => $fila[0],
                    'nombre' => $fila[1] ?? '',
                    'zona' => $fila[2] ?? '',
                    'direccion' => $fila[3],
                    'codigo_postal' => $fila[4] ?? '',
                    'ciudad' => $fila[5] ?? 'BOGOTA D.C.',
                    'departamento' => $fila[6] ?? 'BOGOTA D.C.'
                ];
            }
        }

        foreach ($datos as &$item) {
            $coords = $this->geocodificar($item['direccion'], $item['ciudad']);
            $item['lat'] = $coords ? $coords['lat'] : null;
            $item['lng'] = $coords ? $coords['lng'] : null;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['rutas'] = $datos;

        header('Location: index.php?action=mapa');
        exit;
    }

    public function mapa()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rutas'])) {
            header('Location: index.php');
            exit;
        }

        $rutas = $_SESSION['rutas'];
        require_once BASE_PATH . '/views/map.php';
    }

  
    private function geocodificar($direccion, $ciudad)
    {
        $direccionCompleta = $direccion . ', ' . $ciudad . ', Colombia';
        $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($direccionCompleta);

        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'User-Agent: ' . GEOCODING_USER_AGENT . "\r\n",
                'timeout' => 10
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
            return [
                'lat' => floatval($data[0]['lat']),
                'lng' => floatval($data[0]['lon'])
            ];
        }

        return null;
    }
}
