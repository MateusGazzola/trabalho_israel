<?php $this->layout('layouts/admin', ['title' => 'Detalhes do Cliente']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Detalhes do Cliente</h5>
        <div>
            <a href="/admin/clientes/edit?id=<?= $this->e($cliente['id']) ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>
            <a href="/admin/clientes" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">ID</label>
                <p class="mb-0 fs-5">#<?= $this->e($cliente['id']) ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Nome</label>
                <p class="mb-0 fs-5"><?= $this->e($cliente['nome']) ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">E-mail</label>
                <p class="mb-0"><?= $this->e($cliente['email']) ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Telefone</label>
                <p class="mb-0"><?= $this->e($cliente['telefone'] ?? '-') ?></p>
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold text-muted">Endereço</label>
                <p class="mb-0"><?= $this->e($cliente['endereco'] ?? '-') ?></p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold text-muted">CEP</label>
                <p class="mb-0"><?= $this->e($cliente['cep'] ?? '-') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Cidade</label>
                <p class="mb-0"><?= $this->e($cliente['cidade'] ?? '-') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Estado</label>
                <p class="mb-0"><?= $this->e($cliente['estado'] ?? '-') ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-muted">Cadastrado em</label>
                <p class="mb-0"><?= $this->e($cliente['created_at'] ?? '-') ?></p>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>

