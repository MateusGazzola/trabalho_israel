<?php

namespace App\Models;

class FormaPagamento
{
    public ?int $id = null;
    public string $descricao;
    public string $tipo_pagamento;

    public function __construct(?int $id, string $descricao, string $tipo_pagamento = '')
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->tipo_pagamento = $tipo_pagamento;
    }
}
