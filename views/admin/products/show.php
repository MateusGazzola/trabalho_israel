<?php $this->layout('layouts/admin', ['title' => 'Detalhes do Produto']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Detalhes do Produto</h5>
        <div>
            <a href="/admin/products/edit?id=<?= $this->e($product['id']) ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>
            <a href="/admin/products" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php if (!empty($product['image_path'])): ?>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <img class="img-thumbnail" style="max-width: 100%; height: auto; border-radius: 12px;" 
                             src="<?= $this->e($product['image_path']) ?>" alt="<?= $this->e($product['name']) ?>">
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="<?= !empty($product['image_path']) ? 'col-md-8' : 'col-12' ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">ID</label>
                        <p class="mb-0 fs-5">#<?= $this->e($product['id']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">Nome</label>
                        <p class="mb-0 fs-5"><?= $this->e($product['name']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">Preço</label>
                        <p class="mb-0 fs-5 text-success fw-bold">R$ <?= number_format((float)$product['price'], 2, ',', '.') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">Categoria</label>
                        <p class="mb-0 fs-5">
                            <span class="badge bg-primary"><?= $this->e($product['category_name'] ?? 'N/A') ?></span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">Criado em</label>
                        <p class="mb-0"><?= $this->e($product['created_at'] ?? '-') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
