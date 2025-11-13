<?php $this->layout('layouts/admin', ['title' => 'Novo Produto']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">Novo Produto</h5>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/products/store" enctype="multipart/form-data">
            <?= \App\Core\Csrf::input() ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome *</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           id="name" name="name" placeholder="Digite o nome do produto"
                           value="<?= $this->e($old['name'] ?? '') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['name']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Preço *</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" 
                               id="price" name="price" placeholder="0.00"
                               value="<?= $this->e($old['price'] ?? '') ?>" required>
                    </div>
                    <?php if (isset($errors['price'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['price']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Categoria *</label>
                    <select class="form-select <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>" 
                            id="category_id" name="category_id" required>
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" 
                                    <?= ($old['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                <?= $this->e($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['category_id'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['category_id']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Imagem (opcional)</label>
                    <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" 
                           id="image" name="image" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Formatos aceitos: JPEG, PNG, WEBP</small>
                    <?php if (isset($errors['image'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['image']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Salvar
                </button>
                <a href="/admin/products" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<?php $this->stop() ?>
