<?php

namespace App\Models;

class Pedido
{
    public ?int $id = null;
    public int $cliente_id;
    public int $product_id;
    public int $forma_pagamento_id;
    public int $quantidade;
    public float $valor_total;
    public string $status;
    public string $created_at;

    public function __construct(
        ?int $id,
        int $cliente_id,
        int $product_id,
        int $forma_pagamento_id,
        int $quantidade,
        float $valor_total,
        string $status = 'pendente',
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->product_id = $product_id;
        $this->forma_pagamento_id = $forma_pagamento_id;
        $this->quantidade = $quantidade;
        $this->valor_total = $valor_total;
        $this->status = $status;
        $this->created_at = $created_at;
    }
}

