<?php $this->layout('layouts/admin', ['title' => 'Detalhes do Pedido']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Detalhes do Pedido #<?= $this->e($pedido['id']) ?></h5>
        <div>
            <a href="/admin/pedidos/edit?id=<?= $this->e($pedido['id']) ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>
            <a href="/admin/pedidos" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">ID</label>
                <p class="mb-0 fs-5">#<?= $this->e($pedido['id']) ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Status</label>
                <p class="mb-0">
                    <span class="badge bg-<?= $pedido['status'] === 'concluido' ? 'success' : ($pedido['status'] === 'cancelado' ? 'danger' : 'warning') ?>">
                        <?= ucfirst($this->e($pedido['status'])) ?>
                    </span>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Cliente</label>
                <p class="mb-0 fs-5"><?= $this->e($pedido['cliente_nome'] ?? 'N/A') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Email do Cliente</label>
                <p class="mb-0"><?= $this->e($pedido['cliente_email'] ?? 'N/A') ?></p>
            </div>
            <?php if (!empty($pedido['cliente_telefone'])): ?>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Telefone do Cliente</label>
                <p class="mb-0"><?= $this->e($pedido['cliente_telefone']) ?></p>
            </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Produto</label>
                <p class="mb-0 fs-5"><?= $this->e($pedido['product_name'] ?? 'N/A') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Preço Unitário</label>
                <p class="mb-0">R$ <?= number_format((float)($pedido['product_price'] ?? 0), 2, ',', '.') ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Quantidade</label>
                <p class="mb-0 fs-5"><?= $this->e($pedido['quantidade']) ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Valor Total</label>
                <p class="mb-0 fs-5 text-success fw-bold">R$ <?= number_format((float)$pedido['valor_total'], 2, ',', '.') ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Forma de Pagamento</label>
                <p class="mb-0"><?= $this->e($pedido['forma_pagamento_descricao'] ?? 'N/A') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Tipo de Pagamento</label>
                <p class="mb-0">
                    <span class="badge bg-info"><?= $this->e($pedido['forma_pagamento_tipo'] ?? 'N/A') ?></span>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Data de Criação</label>
                <p class="mb-0"><?= $this->e($pedido['created_at'] ?? 'N/A') ?></p>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>


