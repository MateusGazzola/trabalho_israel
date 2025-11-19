<?php $this->layout('layouts/admin', ['title' => 'Formas de Pagamento']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Lista de Formas de Pagamento</h5>
        <a href="/admin/formaPagamento/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova Forma de Pagamento
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($formasPagamento)): ?>
            <div class="empty-state">
                <i class="bi bi-credit-card"></i>
                <p class="mb-0">Nenhuma forma de pagamento cadastrada ainda.</p>
                <a href="/admin/formaPagamento/create" class="btn btn-primary mt-3">Criar Primeira Forma de Pagamento</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Tipo de Pagamento</th>
                        <th width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($formasPagamento as $formaPagamento): ?>
                        <tr>
                            <td><?= $this->e($formaPagamento['id']) ?></td>
                            <td><strong><?= $this->e($formaPagamento['descricao']) ?></strong></td>
                            <td>
                                <span class="badge bg-info"><?= $this->e($formaPagamento['tipo_pagamento'] ?? '-') ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a class="btn btn-sm btn-secondary" href="/admin/formaPagamento/show?id=<?= $this->e($formaPagamento['id']) ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <form class="d-inline" action="/admin/formaPagamento/delete" method="post"
                                          onsubmit="return confirm('Tem certeza que deseja excluir a forma de pagamento <?= $this->e($formaPagamento['descricao']) ?>?');">
                                        <input type="hidden" name="id" value="<?= $this->e($formaPagamento['id']) ?>">
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

<?php if (!empty($formasPagamento) && $pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="/admin/formaPagamento?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php $this->stop() ?>

