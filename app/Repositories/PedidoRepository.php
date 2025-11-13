<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Pedido;
use PDO;

class PedidoRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM pedidos");
        return (int)$stmt->fetchColumn();
    }

    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare("
            SELECT p.*, 
                   c.nome as cliente_nome, 
                   c.email as cliente_email,
                   pr.name as product_name, 
                   pr.price as product_price,
                   fp.descricao as forma_pagamento_descricao
            FROM pedidos p
            LEFT JOIN clientes c ON p.cliente_id = c.id
            LEFT JOIN products pr ON p.product_id = pr.id
            LEFT JOIN formas_pagamento fp ON p.forma_pagamento_id = fp.id
            ORDER BY p.id DESC
            LIMIT :perPage OFFSET :offset
        ");
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT p.*, 
                   c.nome as cliente_nome, 
                   c.email as cliente_email,
                   c.telefone as cliente_telefone,
                   pr.name as product_name, 
                   pr.price as product_price,
                   pr.image_path as product_image,
                   fp.descricao as forma_pagamento_descricao,
                   fp.tipo_pagamento as forma_pagamento_tipo
            FROM pedidos p
            LEFT JOIN clientes c ON p.cliente_id = c.id
            LEFT JOIN products pr ON p.product_id = pr.id
            LEFT JOIN formas_pagamento fp ON p.forma_pagamento_id = fp.id
            WHERE p.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function create(Pedido $pedido): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO pedidos (cliente_id, product_id, forma_pagamento_id, quantidade, valor_total, status) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $pedido->cliente_id,
            $pedido->product_id,
            $pedido->forma_pagamento_id,
            $pedido->quantidade,
            $pedido->valor_total,
            $pedido->status
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(Pedido $pedido): bool
    {
        $stmt = $this->db->prepare("
            UPDATE pedidos 
            SET cliente_id = ?, product_id = ?, forma_pagamento_id = ?, quantidade = ?, valor_total = ?, status = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $pedido->cliente_id,
            $pedido->product_id,
            $pedido->forma_pagamento_id,
            $pedido->quantidade,
            $pedido->valor_total,
            $pedido->status,
            $pedido->id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM pedidos WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

