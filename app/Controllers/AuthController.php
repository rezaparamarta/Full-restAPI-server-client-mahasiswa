<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class AuthController extends ResourceController
{
    public function login()
    {
        $data = $this->request->getJSON();

        $email = $data->email ?? '';
        $password = $data->password ?? '';

        // Dummy validation
        if ($email !== 'admin@mail.com' || $password !== '123456') {
            return $this->failUnauthorized('Invalid credentials');
        }

        $payload = [
            'iss'   => base_url(),
            'iat'   => time(),
            'exp'   => time() + 3600,
            'email' => $email,
            'role'  => 'admin'
        ];

        $token = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

        return $this->respond([
            'token' => $token
        ]);
    }
}