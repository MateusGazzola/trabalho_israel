<?php

namespace App\Middleware;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthMiddleware
{
    public static function requireLogin(): ?RedirectResponse
    {
        if (!AuthService::check()) {
            return new RedirectResponse('/auth/login');
        }
        return null;
    }
}
