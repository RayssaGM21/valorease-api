<?php
namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Models\Usuario;

class UsuarioService {
    private $repository;

    public function __construct(UsuarioRepository $repository) {
        $this->repository = $repository;
    }

    public function createUsuario($dados) {
        $usuario = new Usuario($dados['nome'], $dados['email'], $dados['telefone'], $dados['data_nascimento']);
        return $this->repository->save($usuario);
    }

    public function getUsuario($id) {
        return $this->repository->find($id);
    }

    public function updateUsuario($id, $dados) {
        $usuario = $this->repository->find($id);
        if ($usuario) {
            $usuario->setNome($dados['nome']);
            $usuario->setEmail($dados['email']);
            $usuario->setTelefone($dados['telefone']);
            $usuario->setDataNascimento($dados['data_nascimento']);
            return $this->repository->update($usuario);
        }
        return null;
    }

    public function deleteUsuario($id) {
        return $this->repository->delete($id);
    }
}
