<?php

namespace App\Models;

class Cliente
{
    public ?int $id = null;
    public string $nome;
    public string $email;
    public ?string $telefone;
    public ?string $endereco;
    public ?string $cidade;
    public ?string $estado;
    public ?string $cep;
    public string $created_at;

    public function __construct(
        ?int $id,
        string $nome,
        string $email,
        ?string $telefone = null,
        ?string $endereco = null,
        ?string $cidade = null,
        ?string $estado = null,
        ?string $cep = null,
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->created_at = $created_at;
    }
}

