<?php
namespace App\Services;

use App\Models\FormaPagamento;

class FormaPagamentoService {
    public function validate(array $data): array {
        $errors = [];
        $descricao = trim($data['descricao'] ?? '');
    
        if ($descricao === '') $errors['descricao'] = 'A descrição é obrigatória';

        return $errors;
    }

    public function make(array $data): FormaPagamento {
        $descricao = trim($data['descricao'] ?? '');
        $tipo_pagamento = trim($data['tipo_pagamento'] ?? '');
        $id = isset($data['id']) ? (int)$data['id'] : null;
        return new FormaPagamento($id, $descricao, $tipo_pagamento);
    }
}
