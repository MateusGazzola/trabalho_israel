<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\FormaPagamentoRepository;
use App\Repositories\PedidoRepository;
use App\Services\FormaPagamentoService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class FormaPagamentoController {

    private View $view;
    private FormaPagamentoRepository $repo;
    private FormaPagamentoService $service;
    private PedidoRepository $pedidoRepo;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new FormaPagamentoRepository();
        $this->service = new FormaPagamentoService();
        $this->pedidoRepo = new PedidoRepository();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $formasPagamento = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/formaPagamento/index', compact('formasPagamento', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $html = $this->view->render('admin/formaPagamento/create', ['csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

   public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) 
        return new Response('Token CSRF inválido', 419);

        $data = [
        'descricao' => trim($request->request->get('descricao')),
        'tipo_pagamento' => trim($request->request->get('tipo_pagamento')),
    ];

        $errors = $this->service->validate($data);
        if ($errors) {
        $html = $this->view->render('admin/formaPagamento/create', [
            'csrf' => Csrf::token(),
            'errors' => $errors,
            'old' => $data
        ]);
        return new Response($html, 422);
    }

    $this->repo->create($data);
    return new RedirectResponse('/admin/formaPagamento');
}


    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $formaPagamento = $this->repo->find($id);
        if (!$formaPagamento) return new Response('Forma de pagamento não encontrada', 404);
        $html = $this->view->render('admin/formaPagamento/show', ['formaPagamento' => $formaPagamento]);
        return new Response($html);
    }

    public function delete(Request $request): Response {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $id = (int)$request->request->get('id', 0);
        
        $pedidos = $this->pedidoRepo->findByFormaPagamentoId($id);
        if (count($pedidos) > 0) {
            Flash::push("danger", "Forma de pagamento não pode ser excluída pois está sendo utilizada em pedidos");
            return new RedirectResponse('/admin/formaPagamento');
        }

        if ($id > 0) $this->repo->delete($id);
        return new RedirectResponse('/admin/formaPagamento');
    }

     public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $formaPagamento = $this->repo->find($id);
        if (!$formaPagamento) return new Response('Forma de pagamento não encontrada', 404);
        $html = $this->view->render('admin/formaPagamento/edit', ['formaPagamento' => $formaPagamento, 'csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

    public function update(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $data = [
            'descricao' => trim($request->request->get('descricao')),
            'tipo_pagamento' => trim($request->request->get('tipo_pagamento')),
        ];
        $id = (int)$request->request->get('id', 0);
        
        $errors = $this->service->validate($data);
        if ($errors) {
            $formaPagamento = $this->repo->find($id);
            if (!$formaPagamento) return new Response('Forma de pagamento não encontrada', 404);
            $html = $this->view->render('admin/formaPagamento/edit', [
                'formaPagamento' => array_merge($formaPagamento, $data),
                'csrf' => Csrf::token(),
                'errors' => $errors
            ]);
            return new Response($html, 422);
        }
        
        $this->repo->update($id, $data);
        return new RedirectResponse('/admin/formaPagamento/show?id=' . $id);
    }
}