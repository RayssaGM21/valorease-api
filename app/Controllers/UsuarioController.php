<?php
namespace App\Controllers;

use App\Services\UsuarioService;

class UsuarioController {
    private $service;

    public function __construct(UsuarioService $service) {
        $this->service = $service;
    }

    public function create() {
        $dados = json_decode(file_get_contents("php://input"), true);
        $this->service->createUsuario($dados);
        echo json_encode(['status' => 'success']);
    }

    public function read($id) {
        $usuario = $this->service->getUsuario($id);
        if ($usuario) {
            echo json_encode($usuario->toArray());
        } else {
            echo json_encode(['status' => 'not found']);
        }
    }

    public function update($id) {
        $dados = json_decode(file_get_contents("php://input"), true);
        $this->service->updateUsuario($id, $dados);
        echo json_encode(['status' => 'success']);
    }

    public function delete($id) {
        $this->service->deleteUsuario($id);
        echo json_encode(['status' => 'success']);
    }
}
