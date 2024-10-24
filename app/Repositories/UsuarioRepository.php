<?php
namespace App\Repositories;

use PDO;
use App\Models\Usuario;

class UsuarioRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Usuario $usuario) {
        $stmt = $this->pdo->prepare('INSERT INTO usuario (Nome, Email, Telefone, Data_Nascimento) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$usuario->getNome(), $usuario->getEmail(), $usuario->getTelefone(), $usuario->getDataNascimento()]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE ID_usuario = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $usuario = new Usuario($data['Nome'], $data['Email'], $data['Telefone'], $data['Data_Nascimento']);
            $usuario->setId($data['ID_usuario']); 
            return $usuario;
        }

        return null;
    }

    public function update(Usuario $usuario) {
        $stmt = $this->pdo->prepare('UPDATE usuario SET Nome = ?, Email = ?, Telefone = ?, Data_Nascimento = ? WHERE ID_usuario = ?');
        return $stmt->execute([$usuario->getNome(), $usuario->getEmail(), $usuario->getTelefone(), $usuario->getDataNascimento(), $usuario->getId()]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM usuario WHERE ID_usuario = ?');
        return $stmt->execute([$id]);
    }
}
