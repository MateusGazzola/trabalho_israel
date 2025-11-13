<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function validate(array $data): array
    {
        $errors = [];
        $nome = trim($data['nome'] ?? '');
        $email = trim($data['email'] ?? '');

        if ($nome === '') {
            $errors['nome'] = 'Nome é obrigatório';
        }
        if ($email === '') {
            $errors['email'] = 'E-mail é obrigatório';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail inválido';
        }

        return $errors;
    }

    public function make(array $data): Cliente
    {
        $nome = trim($data['nome'] ?? '');
        $email = trim($data['email'] ?? '');
        $telefone = trim($data['telefone'] ?? '') ?: null;
        $endereco = trim($data['endereco'] ?? '') ?: null;
        $cidade = trim($data['cidade'] ?? '') ?: null;
        $estado = trim($data['estado'] ?? '') ?: null;
        $cep = trim($data['cep'] ?? '') ?: null;
        $id = isset($data['id']) ? (int)$data['id'] : null;

        return new Cliente(
            $id,
            $nome,
            $email,
            $telefone,
            $endereco,
            $cidade,
            $estado,
            $cep
        );
    }
}

