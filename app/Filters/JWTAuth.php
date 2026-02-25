<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');

        if (!$header) {
            return Services::response()
                ->setJSON(['message' => 'Token Required'])
                ->setStatusCode(401);
        }

        $token = explode(' ', $header)[1];
        $key = getenv('JWT_SECRET');

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON(['message' => 'Invalid Token'])
                ->setStatusCode(401);
        }

        // Role check (optional)
        if (isset($arguments[0]) && $arguments[0] !== $decoded->role) {
            return Services::response()
                ->setJSON(['message' => 'Forbidden'])
                ->setStatusCode(403);
        }

        $request->user = $decoded;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosongkan saja
    }
}