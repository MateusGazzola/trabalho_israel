<?php $this->layout('layouts/admin', ['title' => 'Dashboard']) ?>

<?php $this->start('body') ?>

<div class="row g-4 mb-4">
    <!-- Card de Estatísticas -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-people text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Usuários</h6>
                        <h3 class="mb-0"><?= $stats['users'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-box-seam text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Produtos</h6>
                        <h3 class="mb-0"><?= $stats['products'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-tags text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Categorias</h6>
                        <h3 class="mb-0"><?= $stats['categories'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="bi bi-person-badge text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Clientes</h6>
                        <h3 class="mb-0"><?= $stats['clientes'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-danger bg-opacity-10 rounded p-3">
                            <i class="bi bi-cart-check text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Pedidos</h6>
                        <h3 class="mb-0"><?= $stats['pedidos'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 fw-semibold">Acesso Rápido</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/admin/products/create" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i> Novo Produto
                    </a>
                    <a href="/admin/categories/create" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i> Nova Categoria
                    </a>
                    <a href="/admin/clientes/create" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i> Novo Cliente
                    </a>
                    <a href="/admin/pedidos/create" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i> Novo Pedido
                    </a>
                    <a href="/admin/users/create" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i> Novo Usuário
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 fw-semibold">Bem-vindo ao Painel Administrativo</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">
                    Gerencie seus produtos, categorias, pedidos e usuários de forma simples e eficiente.
                    Use o menu lateral para navegar entre as seções.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>
