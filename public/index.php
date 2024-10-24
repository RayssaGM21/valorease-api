<?php
require '../vendor/autoload.php';

use App\Controllers\UsuarioController;

// Configuração do banco
$config = require '../config/database.php';
$pdo = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);

// Inicialização dos componentes
$repository = new App\Repositories\UsuarioRepository($pdo);
$service = new App\Services\UsuarioService($repository);
$controller = new UsuarioController($service);

// Roteamento básico
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/valorease-api/public/usuarios' && $method === 'POST') {
    $controller->create();
} elseif (preg_match('/\/valorease-api\/public\/usuarios\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $controller->read($matches[1]);
} elseif (preg_match('/\/valorease-api\/public\/usuarios\/(\d+)/', $uri, $matches) && $method === 'PUT') {
    $controller->update($matches[1]);
} elseif (preg_match('/\/valorease-api\/public\/usuarios\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    $controller->delete($matches[1]);
} else {
    http_response_code(404);
    echo json_encode(['status' => 'not found']);
}
?>
