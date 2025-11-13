<?php

use App\Services\AuthService;

$auth = AuthService::user();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title ?? 'CRUD') ?> - Painel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--light-bg);
            color: #334155;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: linear-gradient(135deg, var(--dark-color) 0%, #334155 100%);
            color: white;
            z-index: 1030;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.3s ease;
            z-index: 1020;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.05);
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar .nav-link {
            color: #64748b;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.875rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            font-weight: 500;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: #eff6ff;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar .nav-link i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .sidebar .nav-link span {
            font-size: 0.9375rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            transition: margin-left 0.3s ease;
            padding: 2rem;
            background-color: var(--light-bg);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-header h5 {
            color: var(--dark-color);
            font-weight: 600;
            margin: 0;
        }

        /* Tables */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            white-space: nowrap;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination strong {
            padding: 0.5rem 0.875rem;
            border-radius: 8px;
            text-decoration: none;
            color: var(--secondary-color);
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination strong {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Forms */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0.5rem 0 0 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--secondary-color);
        }

        /* Badges */
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* Footer */
        .footer {
            background-color: white;
            color: var(--secondary-color);
            padding: 1.5rem;
            text-align: center;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            border-top: 1px solid #e2e8f0;
            font-size: 0.875rem;
        }

        .footer.expanded {
            margin-left: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content,
            .footer {
                margin-left: 0;
                padding: 1rem;
            }

            .header .navbar-brand {
                font-size: 1rem;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--secondary-color);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Image Thumbnails */
        .img-thumbnail {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

<!-- Dashboard Screen -->
<div id="dashboardScreen">
    <!-- Header -->
    <nav class="header navbar navbar-dark">
        <div class="container-fluid px-4">
            <button class="btn btn-link text-white p-0" id="menuToggle" style="text-decoration: none;">
                <i class="bi bi-list fs-4"></i>
            </button>
            <span class="navbar-brand mb-0"><?= $this->e($title ?? 'Dashboard') ?></span>
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="user-avatar"><?= strtoupper(substr($auth['name'] ?? 'A', 0, 2)) ?></div>
                    <span id="usernameDisplay" class="d-none d-md-inline"><?= $this->e($auth['name'] ?? 'Admin') ?></span>
                </div>
                <form class="d-inline" method="post" action="/auth/logout">
                    <?= \App\Core\Csrf::input() ?>
                    <button class="btn btn-outline-light btn-sm" id="btnLogout">
                        <i class="bi bi-box-arrow-right"></i> <span class="d-none d-md-inline">Sair</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <nav class="nav flex-column py-3">
            <a class="nav-link" href="/admin" data-page="dashboard">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="/admin/users" data-page="users">
                <i class="bi bi-people"></i>
                <span>Usuários</span>
            </a>
            <a class="nav-link" href="/admin/products" data-page="products">
                <i class="bi bi-box-seam"></i>
                <span>Produtos</span>
            </a>
            <a class="nav-link" href="/admin/categories" data-page="categories">
                <i class="bi bi-tags"></i>
                <span>Categorias</span>
            </a>
            <a class="nav-link" href="/admin/clientes" data-page="clientes">
                <i class="bi bi-person-badge"></i>
                <span>Clientes</span>
            </a>
            <a class="nav-link" href="/admin/formaPagamento" data-page="formapagamento">
                <i class="bi bi-credit-card"></i>
                <span>Formas de Pagamento</span>
            </a>
            <a class="nav-link" href="/admin/pedidos" data-page="pedidos">
                <i class="bi bi-cart-check"></i>
                <span>Pedidos</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="mb-4">
            <h1 class="h3 fw-bold mb-2" id="pageTitle"><?= $this->e($title ?? 'Dashboard') ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $this->e($title ?? 'Dashboard') ?></li>
                </ol>
            </nav>
        </div>

        <!-- Flash Messages -->
        <?php $this->insert('partials/admin/flash') ?>
        
        <!-- Page Content -->
        <?= $this->section('body') ?>
    </main>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <p class="mb-0">&copy; <?= date('Y') ?> Painel Administrativo. Todos os direitos reservados.</p>
    </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle sidebar
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const footer = document.getElementById('footer');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            footer.classList.toggle('expanded');

            // For mobile
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
            }
        });
    }

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            if (sidebar && !sidebar.contains(e.target) && menuToggle && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Set active nav link based on current page
    document.addEventListener('DOMContentLoaded', () => {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (currentPath === href || (href !== '/admin' && currentPath.startsWith(href))) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
</body>
</html>
