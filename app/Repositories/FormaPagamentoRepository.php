<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class FormaPagamentoRepository {
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM formas_pagamento");
        return (int)$stmt->fetchColumn();
    }

    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare("SELECT * FROM formas_pagamento ORDER BY id DESC LIMIT :perPage OFFSET :offset");
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM formas_pagamento WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO formas_pagamento (descricao, tipo_pagamento) VALUES (:descricao, :tipo_pagamento)");
        $stmt->execute([
            'descricao' => $data['descricao'],
            'tipo_pagamento' => $data['tipo_pagamento']
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE formas_pagamento SET descricao = :descricao, tipo_pagamento = :tipo_pagamento WHERE id = :id");
        return $stmt->execute([
            'descricao' => $data['descricao'],
            'tipo_pagamento' => $data['tipo_pagamento'],
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM formas_pagamento WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM formas_pagamento ORDER BY descricao ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
