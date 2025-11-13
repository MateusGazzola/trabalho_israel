<?php $this->layout('layouts/admin', ['title' => 'Editar Pedido']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">Editar Pedido #<?= $this->e($pedido['id']) ?></h5>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/pedidos/update">
            <?= \App\Core\Csrf::input() ?>
            <input type="hidden" name="id" value="<?= $this->e($pedido['id']) ?>">
            
            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente *</label>
                <select class="form-select <?= isset($errors['cliente_id']) ? 'is-invalid' : '' ?>" 
                        id="cliente_id" name="cliente_id" required>
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $this->e($cliente['id']) ?>" 
                                <?= ($pedido['cliente_id'] == $cliente['id']) ? 'selected' : '' ?>>
                            <?= $this->e($cliente['nome']) ?> (<?= $this->e($cliente['email']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['cliente_id'])): ?>
                    <div class="invalid-feedback d-block"><?= $this->e($errors['cliente_id']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Produto *</label>
                <select class="form-select <?= isset($errors['product_id']) ? 'is-invalid' : '' ?>" 
                        id="product_id" name="product_id" required>
                    <option value="">Selecione um produto</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $this->e($product['id']) ?>" 
                                data-price="<?= $this->e($product['price']) ?>"
                                <?= ($pedido['product_id'] == $product['id']) ? 'selected' : '' ?>>
                            <?= $this->e($product['name']) ?> - R$ <?= number_format((float)$product['price'], 2, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['product_id'])): ?>
                    <div class="invalid-feedback d-block"><?= $this->e($errors['product_id']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade *</label>
                <input type="number" class="form-control <?= isset($errors['quantidade']) ? 'is-invalid' : '' ?>" 
                       id="quantidade" name="quantidade" min="1" 
                       value="<?= $this->e($pedido['quantidade']) ?>" required>
                <?php if (isset($errors['quantidade'])): ?>
                    <div class="invalid-feedback d-block"><?= $this->e($errors['quantidade']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="forma_pagamento_id" class="form-label">Forma de Pagamento *</label>
                <select class="form-select <?= isset($errors['forma_pagamento_id']) ? 'is-invalid' : '' ?>" 
                        id="forma_pagamento_id" name="forma_pagamento_id" required>
                    <option value="">Selecione uma forma de pagamento</option>
                    <?php foreach ($formasPagamento as $fp): ?>
                        <option value="<?= $this->e($fp['id']) ?>" 
                                <?= ($pedido['forma_pagamento_id'] == $fp['id']) ? 'selected' : '' ?>>
                            <?= $this->e($fp['descricao']) ?> (<?= $this->e($fp['tipo_pagamento'] ?? 'N/A') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['forma_pagamento_id'])): ?>
                    <div class="invalid-feedback d-block"><?= $this->e($errors['forma_pagamento_id']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pendente" <?= ($pedido['status'] == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="concluido" <?= ($pedido['status'] == 'concluido') ? 'selected' : '' ?>>Concluído</option>
                    <option value="cancelado" <?= ($pedido['status'] == 'cancelado') ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Atualizar Pedido
                </button>
                <a href="/admin/pedidos" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->stop() ?>

