<?php

namespace App\Controllers\Admin;

use App\Core\View;
use App\Repositories\CategoryRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\PedidoRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(Request $request): Response
    {
        $userRepo = new UserRepository();
        $productRepo = new ProductRepository();
        $categoryRepo = new CategoryRepository();
        $clienteRepo = new ClienteRepository();
        $pedidoRepo = new PedidoRepository();

        $stats = [
            'users' => $userRepo->countAll(),
            'products' => $productRepo->countAll(),
            'categories' => $categoryRepo->countAll(),
            'clientes' => $clienteRepo->countAll(),
            'pedidos' => $pedidoRepo->countAll()
        ];

        $html = $this->view->render('admin/index', ['stats' => $stats]);
        return new Response($html);
    }
}
