<?php $this->layout('layouts/admin', ['title' => 'Usuários']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Lista de Usuários</h5>
        <a href="/admin/users/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Usuário
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($users)): ?>
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <p class="mb-0">Nenhum usuário cadastrado ainda.</p>
                <a href="/admin/users/create" class="btn btn-primary mt-3">Criar Primeiro Usuário</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Criado em</th>
                        <th width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->e($user['id']) ?></td>
                            <td><strong><?= $this->e($user['name']) ?></strong></td>
                            <td><?= $this->e($user['email']) ?></td>
                            <td><?= $this->e($user['created_at'] ?? '-') ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a class="btn btn-sm btn-secondary" href="/admin/users/show?id=<?= $this->e($user['id']) ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form class="d-inline" action="/admin/users/delete" method="post"
                                          onsubmit="return confirm('Tem certeza que deseja excluir o usuário <?= $this->e($user['name']) ?>?');">
                                        <input type="hidden" name="id" value="<?= $this->e($user['id']) ?>">
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

<?php if (!empty($users) && $pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="/admin/users?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php $this->stop() ?>
