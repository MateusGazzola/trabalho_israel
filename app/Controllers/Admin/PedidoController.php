<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\PedidoRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\FormaPagamentoRepository;
use App\Services\PedidoService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PedidoController
{
    private View $view;
    private PedidoRepository $repo;
    private PedidoService $service;
    private ClienteRepository $clienteRepo;
    private ProductRepository $productRepo;
    private FormaPagamentoRepository $formaPagamentoRepo;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new PedidoRepository();
        $this->service = new PedidoService();
        $this->clienteRepo = new ClienteRepository();
        $this->productRepo = new ProductRepository();
        $this->formaPagamentoRepo = new FormaPagamentoRepository();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $pedidos = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/pedidos/index', compact('pedidos', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $clientes = $this->clienteRepo->findAll();
        $products = $this->productRepo->findAll();
        $formasPagamento = $this->formaPagamentoRepo->findAll();
        
        $html = $this->view->render('admin/pedidos/create', [
            'csrf' => Csrf::token(),
            'errors' => [],
            'clientes' => $clientes,
            'products' => $products,
            'formasPagamento' => $formasPagamento
        ]);
        return new Response($html);
    }

    public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) {
            return new Response('Token CSRF inválido', 419);
        }
        
        $errors = $this->service->validate($request->request->all());
        
        if ($errors) {
            $clientes = $this->clienteRepo->findAll();
            $products = $this->productRepo->findAll();
            $formasPagamento = $this->formaPagamentoRepo->findAll();
            
            $html = $this->view->render('admin/pedidos/create', [
                'csrf' => Csrf::token(),
                'errors' => $errors,
                'old' => $request->request->all(),
                'clientes' => $clientes,
                'products' => $products,
                'formasPagamento' => $formasPagamento
            ]);
            return new Response($html, 422);
        }
        
        $pedido = $this->service->make($request->request->all());
        $id = $this->repo->create($pedido);
        Flash::push('success', 'Pedido criado com sucesso!');
        return new RedirectResponse('/admin/pedidos/show?id=' . $id);
    }

    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $pedido = $this->repo->find($id);
        if (!$pedido) {
            return new Response('Pedido não encontrado', 404);
        }
        $html = $this->view->render('admin/pedidos/show', ['pedido' => $pedido]);
        return new Response($html);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $pedido = $this->repo->find($id);
        if (!$pedido) {
            return new Response('Pedido não encontrado', 404);
        }
        
        $clientes = $this->clienteRepo->findAll();
        $products = $this->productRepo->findAll();
        $formasPagamento = $this->formaPagamentoRepo->findAll();
        
        $html = $this->view->render('admin/pedidos/edit', [
            'pedido' => $pedido,
            'csrf' => Csrf::token(),
            'errors' => [],
            'clientes' => $clientes,
            'products' => $products,
            'formasPagamento' => $formasPagamento
        ]);
        return new Response($html);
    }

    public function update(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) {
            return new Response('Token CSRF inválido', 419);
        }
        
        $data = $request->request->all();
        $errors = $this->service->validate($data);
        
        if ($errors) {
            $pedido = $this->repo->find((int)$data['id']);
            if (!$pedido) {
                return new Response('Pedido não encontrado', 404);
            }
            
            $clientes = $this->clienteRepo->findAll();
            $products = $this->productRepo->findAll();
            $formasPagamento = $this->formaPagamentoRepo->findAll();
            
            $html = $this->view->render('admin/pedidos/edit', [
                'pedido' => array_merge($pedido, $data),
                'csrf' => Csrf::token(),
                'errors' => $errors,
                'clientes' => $clientes,
                'products' => $products,
                'formasPagamento' => $formasPagamento
            ]);
            return new Response($html, 422);
        }
        
        $pedido = $this->service->make($data);
        if (!$pedido->id) {
            return new Response('ID inválido', 422);
        }
        
        $this->repo->update($pedido);
        Flash::push('success', 'Pedido atualizado com sucesso!');
        return new RedirectResponse('/admin/pedidos/show?id=' . $pedido->id);
    }

    public function delete(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) {
            return new Response('Token CSRF inválido', 419);
        }
        
        $id = (int)$request->request->get('id', 0);
        if ($id > 0) {
            $this->repo->delete($id);
            Flash::push('success', 'Pedido excluído com sucesso!');
        }
        return new RedirectResponse('/admin/pedidos');
    }
}

