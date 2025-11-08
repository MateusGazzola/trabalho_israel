<?php $this->layout('layouts/admin', ['title' => 'Nova forma de pagamento']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Nova forma de pagamento']) ?>
    <div class="card-body">
        <form method="post" action="/admin/formaPagamento/store" enctype="multipart/form-data" class="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição"
                           value="<?= $this->e(($old['descricao'] ?? '')) ?>">
                    <?php if (!empty($errors['descricao'])): ?>
                        <div class="text-danger"><?= $this->e($errors['descricao']) ?></div><?php endif; ?>
                </div>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Salvar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/formaPagamento" class="btn align-self-end">
                    <i class="bi bi-x-lg"></i> Cancelar
                </a>
            </div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>
</div>
<?php $this->stop() ?>
