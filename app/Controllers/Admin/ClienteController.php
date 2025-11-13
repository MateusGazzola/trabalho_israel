<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\ClienteRepository;
use App\Services\ClienteService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController
{
    private View $view;
    private ClienteRepository $repo;
    private ClienteService $service;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new ClienteRepository();
        $this->service = new ClienteService();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $clientes = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/clientes/index', compact('clientes', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $html = $this->view->render('admin/clientes/create', [
            'csrf' => Csrf::token(),
            'errors' => []
        ]);
        return new Response($html);
    }

    public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) {
            return new Response('Token CSRF inválido', 419);
        }

        $errors = $this->service->validate($request->request->all());

        $emailExists = $this->repo->findByEmail($request->request->get('email'));
        if ($emailExists) {
            $errors['email'] = "E-mail já cadastrado.";
        }

        if ($errors) {
            $html = $this->view->render('admin/clientes/create', [
                'csrf' => Csrf::token(),
                'errors' => $errors,
                'old' => $request->request->all()
            ]);
            return new Response($html, 422);
        }

        $cliente = $this->service->make($request->request->all());
        $id = $this->repo->create($cliente);
        Flash::push('success', 'Cliente cadastrado com sucesso!');
        return new RedirectResponse('/admin/clientes/show?id=' . $id);
    }

    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $cliente = $this->repo->find($id);
        if (!$cliente) {
            return new Response('Cliente não encontrado', 404);
        }
        $html = $this->view->render('admin/clientes/show', ['cliente' => $cliente]);
        return new Response($html);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $cliente = $this->repo->find($id);
        if (!$cliente) {
            return new Response('Cliente não encontrado', 404);
        }
        $html = $this->view->render('admin/clientes/edit', [
            'cliente' => $cliente,
            'csrf' => Csrf::token(),
            'errors' => []
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

        $emailExists = $this->repo->findByEmailNotId($request->request->get('email'), (int)$data['id']);
        if ($emailExists) {
            $errors['email'] = "E-mail já cadastrado.";
        }

        if ($errors) {
            $cliente = $this->repo->find((int)$data['id']);
            if (!$cliente) {
                return new Response('Cliente não encontrado', 404);
            }
            $html = $this->view->render('admin/clientes/edit', [
                'cliente' => array_merge($cliente, $data),
                'csrf' => Csrf::token(),
                'errors' => $errors
            ]);
            return new Response($html, 422);
        }

        $cliente = $this->service->make($data);
        if (!$cliente->id) {
            return new Response('ID inválido', 422);
        }

        $this->repo->update($cliente);
        Flash::push('success', 'Cliente atualizado com sucesso!');
        return new RedirectResponse('/admin/clientes/show?id=' . $cliente->id);
    }

    public function delete(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) {
            return new Response('Token CSRF inválido', 419);
        }

        $id = (int)$request->request->get('id', 0);
        if ($id > 0) {
            $this->repo->delete($id);
            Flash::push('success', 'Cliente excluído com sucesso!');
        }
        return new RedirectResponse('/admin/clientes');
    }
}

