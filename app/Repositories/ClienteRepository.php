<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Cliente;
use PDO;

class ClienteRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM clientes");
        return (int)$stmt->fetchColumn();
    }

    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare("SELECT * FROM clientes ORDER BY id DESC LIMIT :perPage OFFSET :offset");
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM clientes ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(Cliente $cliente): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO clientes (nome, email, telefone, endereco, cidade, estado, cep) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cliente->nome,
            $cliente->email,
            $cliente->telefone,
            $cliente->endereco,
            $cliente->cidade,
            $cliente->estado,
            $cliente->cep
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(Cliente $cliente): bool
    {
        $stmt = $this->db->prepare("
            UPDATE clientes 
            SET nome = ?, email = ?, telefone = ?, endereco = ?, cidade = ?, estado = ?, cep = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $cliente->nome,
            $cliente->email,
            $cliente->telefone,
            $cliente->endereco,
            $cliente->cidade,
            $cliente->estado,
            $cliente->cep,
            $cliente->id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByEmailNotId(string $email, int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE email = :email AND id != :id LIMIT 1");
        $stmt->execute(['email' => $email, 'id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}

