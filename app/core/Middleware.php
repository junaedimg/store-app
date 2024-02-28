<?php

namespace app\core;

use app\middleware\SessionMiddleware;
use app\middleware\AuthMiddleware;

class Middleware
{
    public function __construct()
    {
        // Inisialisasi rantai middleware
        $middlewareChain = $this->initializeMiddlewareChain();
        $this->handleMiddleware($middlewareChain);
    }

    protected function initializeMiddlewareChain()
    {
        return [
            new SessionMiddleware(),
            new AuthMiddleware()
        ];
    }
    public function handleMiddleware($middlewareChain)
    {
        // Melakukan iterasi untuk menjalankan setiap middleware dalam chain
        foreach ($middlewareChain as $middleware) {
            $middleware->handle();
        }
    }
}
