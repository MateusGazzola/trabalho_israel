<?php $this->layout('layouts/admin', ['title' => 'Nova Forma de Pagamento']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Nova Forma de Pagamento']) ?>
    <div class="card-body">
        <form method="post" action="/admin/formaPagamento/store">
            <?= \App\Core\Csrf::input() ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao"
                           placeholder="Digite a descrição"
                           value="<?= $this->e($old['descricao'] ?? '') ?>">
                    <?php if (!empty($errors['descricao'])): ?>
                        <div class="text-danger"><?= $this->e($errors['descricao']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipo_pagamento" class="form-label">Tipo de Pagamento</label>
                    <select class="form-select" id="tipo_pagamento" name="tipo_pagamento">
                        <option value="">Selecione...</option>
                        <option value="Pix" <?= (($old['tipo_pagamento'] ?? '') === 'Pix') ? 'selected' : '' ?>>Pix</option>
                        <option value="Cartão" <?= (($old['tipo_pagamento'] ?? '') === 'Cartão') ? 'selected' : '' ?>>Cartão</option>
                        <option value="Dinheiro" <?= (($old['tipo_pagamento'] ?? '') === 'Dinheiro') ? 'selected' : '' ?>>Dinheiro</option>
                    </select>
                    <?php if (!empty($errors['tipo_pagamento'])): ?>
                        <div class="text-danger"><?= $this->e($errors['tipo_pagamento']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Salvar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/formaPagamento" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<?php $this->stop() ?>
