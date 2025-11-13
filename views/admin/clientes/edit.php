<?php $this->layout('layouts/admin', ['title' => 'Editar Cliente']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">Editar Cliente</h5>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/clientes/update">
            <?= \App\Core\Csrf::input() ?>
            <input type="hidden" name="id" value="<?= $this->e($cliente['id']) ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control <?= isset($errors['nome']) ? 'is-invalid' : '' ?>" 
                           id="nome" name="nome" placeholder="Digite o nome completo"
                           value="<?= $this->e($cliente['nome'] ?? '') ?>" required>
                    <?php if (isset($errors['nome'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['nome']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail *</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           id="email" name="email" placeholder="exemplo@email.com"
                           value="<?= $this->e($cliente['email'] ?? '') ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback d-block"><?= $this->e($errors['email']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" 
                           placeholder="(00) 00000-0000" value="<?= $this->e($cliente['telefone'] ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" 
                           placeholder="00000-000" value="<?= $this->e($cliente['cep'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" 
                           placeholder="Rua, número, complemento" value="<?= $this->e($cliente['endereco'] ?? '') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" 
                           placeholder="Nome da cidade" value="<?= $this->e($cliente['cidade'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" 
                           placeholder="UF" maxlength="2" value="<?= $this->e($cliente['estado'] ?? '') ?>">
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Atualizar
                </button>
                <a href="/admin/clientes" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<?php $this->stop() ?>

