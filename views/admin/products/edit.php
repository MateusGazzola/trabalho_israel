<?php $this->layout('layouts/admin', ['title' => 'Editar Produto']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">Editar Produto</h5>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/products/update" enctype="multipart/form-data">
            <?= \App\Core\Csrf::input() ?>
            <input type="hidden" name="id" value="<?= $this->e($product['id']) ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome *</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           id="name" name="name" placeholder="Digite o nome do produto"
                           value="<?= $this->e($product['name'] ?? '') ?>" required>
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
                               value="<?= $this->e($product['price'] ?? '') ?>" required>
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
                                    <?= ($product['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
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
                    <?php if (!empty($product['image_path'])): ?>
                        <div class="mb-2">
                            <img class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;" 
                                 src="<?= $this->e($product['image_path']) ?>" alt="Imagem atual">
                            <p class="text-muted small mb-0 mt-1">Imagem atual</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" 
                           id="image" name="image" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Deixe em branco para manter a imagem atual</small>
                    <?php if (isset($errors['image'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['image']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Atualizar
                </button>
                <a href="/admin/products" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<?php $this->stop() ?>
