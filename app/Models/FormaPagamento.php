<?php

namespace App\Models;

class FormaPagamento
{
    public ?int $id;
    public string $descricao;

    public function __construct(?int $id, string $descricao)
    {
        $this->id = $id;
        $this->descricao = $descricao;
    }
}
