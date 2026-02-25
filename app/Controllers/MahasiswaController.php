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
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data = $this->model->like('nama', $keyword)->findAll();
        } else {
            $data = $this->model->findAll();
        }

        return $this->respond(['data' => $data]);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        $this->model->insert($data);

        return $this->respondCreated([
            'message' => 'Mahasiswa created'
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data not found');
        }

        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Mahasiswa updated'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data not found');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Mahasiswa deleted'
        ]);
    }
}