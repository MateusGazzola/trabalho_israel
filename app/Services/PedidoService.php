<?php

namespace App\Services;

use App\Models\Pedido;
use App\Repositories\ProductRepository;
use App\Repositories\ClienteRepository;

class PedidoService
{
    private ProductRepository $productRepo;
    private ClienteRepository $clienteRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepository();
        $this->clienteRepo = new ClienteRepository();
    }

    public function validate(array $data): array
    {
        $errors = [];
        $cliente_id = $data['cliente_id'] ?? '';
        $product_id = $data['product_id'] ?? '';
        $forma_pagamento_id = $data['forma_pagamento_id'] ?? '';
        $quantidade = $data['quantidade'] ?? '';

        if ($cliente_id === '' || !is_numeric($cliente_id)) {
            $errors['cliente_id'] = 'Cliente é obrigatório';
        }
        if ($product_id === '' || !is_numeric($product_id)) {
            $errors['product_id'] = 'Produto é obrigatório';
        }
        if ($forma_pagamento_id === '' || !is_numeric($forma_pagamento_id)) {
            $errors['forma_pagamento_id'] = 'Forma de pagamento é obrigatória';
        }
        if ($quantidade === '' || !is_numeric($quantidade) || (int)$quantidade <= 0) {
            $errors['quantidade'] = 'Quantidade deve ser maior que zero';
        }

        if ($cliente_id && is_numeric($cliente_id)) {
            $cliente = $this->clienteRepo->find((int)$cliente_id);
            if (!$cliente) {
                $errors['cliente_id'] = 'Cliente não encontrado';
            }
        }

        if ($product_id && is_numeric($product_id)) {
            $product = $this->productRepo->find((int)$product_id);
            if (!$product) {
                $errors['product_id'] = 'Produto não encontrado';
            }
        }

        return $errors;
    }

    public function make(array $data): Pedido
    {
        $cliente_id = (int)($data['cliente_id'] ?? 0);
        $product_id = (int)($data['product_id'] ?? 0);
        $forma_pagamento_id = (int)($data['forma_pagamento_id'] ?? 0);
        $quantidade = (int)($data['quantidade'] ?? 1);
        $status = trim($data['status'] ?? 'pendente');
        $id = isset($data['id']) ? (int)$data['id'] : null;

        $valor_total = 0.0;
        if ($product_id > 0) {
            $product = $this->productRepo->find($product_id);
            if ($product && isset($product['price'])) {
                $valor_total = (float)$product['price'] * $quantidade;
            }
        }

        return new Pedido(
            $id,
            $cliente_id,
            $product_id,
            $forma_pagamento_id,
            $quantidade,
            $valor_total,
            $status
        );
    }
}

