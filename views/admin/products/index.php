<?php $this->layout('layouts/admin', ['title' => 'Produtos']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Lista de Produtos</h5>
        <a href="/admin/products/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Produto
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($products)): ?>
            <div class="empty-state">
                <i class="bi bi-box"></i>
                <p class="mb-0">Nenhum produto cadastrado ainda.</p>
                <a href="/admin/products/create" class="btn btn-primary mt-3">Criar Primeiro Produto</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Criado em</th>
                        <th width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $this->e($product['id']) ?></td>
                            <td>
                                <?php if (!empty($product['image_path'])): ?>
                                    <img class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;"
                                         src="<?= $this->e($product['image_path']) ?>"
                                         alt="<?= $this->e($product['name']) ?>">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?= $this->e($product['name']) ?></td>
                            <td><?= $this->e($categories[$product['category_id']] ?? 'N/A') ?></td>
                            <td><strong>R$ <?= number_format((float)$product['price'], 2, ',', '.') ?></strong></td>
                            <td><?= $this->e($product['created_at'] ?? '-') ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a class="btn btn-sm btn-secondary" href="/admin/products/show?id=<?= $this->e($product['id']) ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="/admin/products/edit?id=<?= $this->e($product['id']) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form class="d-inline" action="/admin/products/delete" method="post"
                                          onsubmit="return confirm('Tem certeza que deseja excluir o produto <?= $this->e($product['name']) ?>?');">
                                        <input type="hidden" name="id" value="<?= $this->e($product['id']) ?>">
                                        <?= \App\Core\Csrf::input() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($products) && $pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="/admin/products?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php $this->stop() ?>
