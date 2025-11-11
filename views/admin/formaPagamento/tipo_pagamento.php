<div class="mb-3">
    <label for="tipo_pagamento" class="form-label">Tipo de Pagamento</label>
    <select name="tipo_pagamento" id="tipo_pagamento" class="form-select" required>
        <option value="">Selecione...</option>
        <option value="Cartão" <?= isset($formaPagamento['tipo_pagamento']) && $formaPagamento['tipo_pagamento'] == 'Cartão' ? 'selected' : '' ?>>Cartão</option>
        <option value="Dinheiro" <?= isset($formaPagamento['tipo_pagamento']) && $formaPagamento['tipo_pagamento'] == 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
        <option value="Pix" <?= isset($formaPagamento['tipo_pagamento']) && $formaPagamento['tipo_pagamento'] == 'Pix' ? 'selected' : '' ?>>Pix</option>
        <option value="Boleto" <?= isset($formaPagamento['tipo_pagamento']) && $formaPagamento['tipo_pagamento'] == 'Boleto' ? 'selected' : '' ?>>Boleto</option>
    </select>
</div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>  
</div>  
