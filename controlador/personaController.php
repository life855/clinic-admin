<?php
// controlador/personaController.php
session_start();
require_once __DIR__ . '/../negocio/PersonaService.php';

$action = $_GET['action'] ?? $_POST['action'] ?? null;
$service = new PersonaService();

// Establece cabeceras JSON (AJAX)
header('Content-Type: application/json; charset=utf-8');

try {
    if ($action === 'login') {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $usuario = $input['usuario'] ?? '';
        $clave = $input['clave'] ?? '';

        if (empty($usuario) || empty($clave)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Usuario y clave requeridos']);
            exit;
        }
        $user = $service->login($usuario, $clave);

        if ($user) {
            // crear sesión
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'user' => $user]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario o clave incorrecta']);
            exit;
        }
        
    } elseif ($action === 'register') {
        // ejemplo de registro, cuerpo JSON
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success'=>false,'message'=>'payload inválido']);
            exit;
        }
        // validar campos mínimos (ejemplo)
        $nombres = $input['nombres'] ?? null;
        $apellido = $input['apellido'] ?? null;
        $usuario = $input['usuario'] ?? null;
        $clave_plain = $input['clave'] ?? "123123";

        if (!$nombres || !$apellido) {
            http_response_code(400);
            echo json_encode(['success'=>false,'message'=>'Faltan datos obligatorios']);
            exit;
        }

        // hash de la clave en PHP
        // $clave_hash = password_hash($clave_plain, PASSWORD_BCRYPT);

        $personaData = [
            'nombres' => $nombres,
            'apellido' => $apellido,
            'nacimiento' => $input['nacimiento'] ?? null,
            'usuario' => $usuario,
            'clave' => $clave_plain,
            'genero' => $input['genero'] ?? null,
            'estadoCivil' => $input['estadoCivil'] ?? null
        ];

        $docs = $input['docs'] ?? null; // array de objetos
        $tels = $input['tels'] ?? null;
        $dirs = $input['dirs'] ?? null;

        $newId = $service->registrarPersona($personaData, $docs, $tels, $dirs);
        echo json_encode(['success'=>true,'per_cod'=>$newId]);
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['success'=>false,'message'=>'Acción inválida']);
        exit;
    }
} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(['success'=>false,'message'=>$ex->getMessage()]);
    exit;
}
