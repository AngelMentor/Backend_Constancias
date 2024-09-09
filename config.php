<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'inlcudes/DataBase.php';
include 'inlcudes/Endpoints.php';

$database = new DataBase();
$db = $database->getConnection();
$usuarioapi = new Endpoints($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'ObtenerUsuarios':
                $usuarios = $usuarioapi->ObtenerUsuarios();
                header('Content-Type: application/json');
                echo json_encode($usuarios);
                break;

            case 'ObtenerPdf':

                $file_path = 'documentos/Certificado_las_emociones_en_la_negociacion.pdf';

                if (file_exists($file_path)) {
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
                    header('Content-Length: ' . filesize($file_path));
                    readfile($file_path);
                    exit();
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Archivo PDF no encontrado']);
                }
                break;
            
            case 'InfoUsuarios':
                $file_path = 'datos/info.json';
                if (file_exists($file_path)) {
                    header('Content-Type: application/json');
                    echo file_get_contents($file_path);
                } else {
                    echo json_encode(['error' => 'Archivo no encontrado']);
                }
                break;

            default:
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Acción no válida']);
                break;
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Acción no especificada']);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}
