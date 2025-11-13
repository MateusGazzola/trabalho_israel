<?php $this->layout('layouts/admin', ['title' => 'Pedidos']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Lista de Pedidos</h5>
        <a href="/admin/pedidos/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Pedido
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($pedidos)): ?>
            <div class="empty-state">
                <i class="bi bi-cart"></i>
                <p class="mb-0">Nenhum pedido cadastrado ainda.</p>
                <a href="/admin/pedidos/create" class="btn btn-primary mt-3">Criar Primeiro Pedido</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $this->e($pedido['id']) ?></td>
                            <td><?= $this->e($pedido['cliente_nome'] ?? 'N/A') ?></td>
                            <td><?= $this->e($pedido['product_name'] ?? 'N/A') ?></td>
                            <td><?= $this->e($pedido['quantidade']) ?></td>
                            <td><strong>R$ <?= number_format((float)$pedido['valor_total'], 2, ',', '.') ?></strong></td>
                            <td>
                                <span class="badge bg-<?= $pedido['status'] === 'concluido' ? 'success' : ($pedido['status'] === 'cancelado' ? 'danger' : 'warning') ?>">
                                    <?= ucfirst($this->e($pedido['status'])) ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a class="btn btn-sm btn-secondary" href="/admin/pedidos/show?id=<?= $this->e($pedido['id']) ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="/admin/pedidos/edit?id=<?= $this->e($pedido['id']) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form class="d-inline" action="/admin/pedidos/delete" method="post"
                                          onsubmit="return confirm('Tem certeza que deseja excluir este pedido?');">
                                        <input type="hidden" name="id" value="<?= $this->e($pedido['id']) ?>">
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

<?php if (!empty($pedidos) && $pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="/admin/pedidos?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php $this->stop() ?>
