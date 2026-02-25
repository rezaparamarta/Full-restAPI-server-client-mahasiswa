<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MahasiswaModel;

class MahasiswaController extends ResourceController
{
    protected $modelName = MahasiswaModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        return $this->respond($this->model->find($id));
    }
}