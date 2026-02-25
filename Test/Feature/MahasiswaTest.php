<?php

namespace Tests\Feature;

use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class MahasiswaTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;

    public function testGetMahasiswa()
    {
        $result = $this->get('/mahasiswa');

        $result->assertStatus(200)
               ->assertJSONStructure([
                   '*' => [
                       'id',
                       'nama',
                       'nrp',
                       'email',
                       'jurusan'
                   ]
               ]);
    }

    public function testCreateMahasiswa()
    {
        $data = [
            'nama'    => 'Reza',
            'nrp'     => '99999',
            'email'   => 'reza@gmail.com',
            'jurusan' => 'Backend'
        ];

        $result = $this->post('/mahasiswa', $data);

        $result->assertStatus(201)
               ->assertJSONFragment([
                   'nama' => 'Reza',
                   'nrp'  => '99999'
               ]);
    }

    public function testCreateMahasiswaValidationFail()
    {
        $data = [
            'nama'    => '',
            'nrp'     => '',
            'email'   => 'salahformat',
            'jurusan' => ''
        ];

        $result = $this->post('/mahasiswa', $data);

        $result->assertStatus(400);
    }

    public function testDuplicateNRPFail()
    {
        $data = [
            'nama'    => 'Reza',
            'nrp'     => '12345',
            'email'   => 'reza@test.com',
            'jurusan' => 'Backend'
        ];

        // Insert pertama
        $this->post('/mahasiswa', $data);

        // Insert kedua dengan nrp sama
        $result = $this->post('/mahasiswa', $data);

        $result->assertStatus(400);
    }

    public function testDatabaseAfterCreate()
    {
        $data = [
            'nama'    => 'DB Test',
            'nrp'     => '11111',
            'email'   => 'db@test.com',
            'jurusan' => 'Backend'
        ];

        $this->post('/mahasiswa', $data);

        $this->seeInDatabase('mahasiswa', [
            'nrp' => '11111'
        ]);
    }
}