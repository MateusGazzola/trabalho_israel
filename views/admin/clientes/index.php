<?php $this->layout('layouts/admin', ['title' => 'Clientes']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Lista de Clientes</h5>
        <a href="/admin/clientes/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Cliente
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($clientes)): ?>
            <div class="empty-state">
                <i class="bi bi-person"></i>
                <p class="mb-0">Nenhum cliente cadastrado ainda.</p>
                <a href="/admin/clientes/create" class="btn btn-primary mt-3">Criar Primeiro Cliente</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Cidade</th>
                        <th width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $this->e($cliente['id']) ?></td>
                            <td><strong><?= $this->e($cliente['nome']) ?></strong></td>
                            <td><?= $this->e($cliente['email']) ?></td>
                            <td><?= $this->e($cliente['telefone'] ?? '-') ?></td>
                            <td><?= $this->e($cliente['cidade'] ?? '-') ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a class="btn btn-sm btn-secondary" href="/admin/clientes/show?id=<?= $this->e($cliente['id']) ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="/admin/clientes/edit?id=<?= $this->e($cliente['id']) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form class="d-inline" action="/admin/clientes/delete" method="post"
                                          onsubmit="return confirm('Tem certeza que deseja excluir o cliente <?= $this->e($cliente['nome']) ?>?');">
                                        <input type="hidden" name="id" value="<?= $this->e($cliente['id']) ?>">
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

<?php if (!empty($clientes) && $pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="/admin/clientes?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php $this->stop() ?>

