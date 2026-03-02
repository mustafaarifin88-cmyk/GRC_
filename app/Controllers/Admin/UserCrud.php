<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserCrud extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user_crud/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru'
        ];
        return view('admin/user_crud/create', $data);
    }

    public function store()
    {
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = 'default-profile.png';

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/profiles', $namaFoto);
        }

        $this->userModel->insert([
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'level'        => $this->request->getPost('level'),
            'foto'         => $namaFoto
        ]);

        session()->setFlashdata('success', 'User berhasil ditambahkan');
        return redirect()->to(base_url('admin/users'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user'  => $this->userModel->find($id)
        ];
        return view('admin/user_crud/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        $fileFoto = $this->request->getFile('foto');
        $dataUpdate = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'level'        => $this->request->getPost('level')
        ];

        if ($this->request->getPost('password')) {
            $dataUpdate['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/profiles', $namaFoto);
            $dataUpdate['foto'] = $namaFoto;

            if ($user['foto'] != 'default-profile.png' && file_exists(FCPATH . 'uploads/profiles/' . $user['foto'])) {
                unlink(FCPATH . 'uploads/profiles/' . $user['foto']);
            }
        }

        $this->userModel->update($id, $dataUpdate);
        session()->setFlashdata('success', 'User berhasil diupdate');
        return redirect()->to(base_url('admin/users'));
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if ($user['foto'] != 'default-profile.png' && file_exists(FCPATH . 'uploads/profiles/' . $user['foto'])) {
            unlink(FCPATH . 'uploads/profiles/' . $user['foto']);
        }
        $this->userModel->delete($id);
        session()->setFlashdata('success', 'User berhasil dihapus');
        return redirect()->to(base_url('admin/users'));
    }

    public function import_excel()
    {
        $file = $this->request->getFile('file_excel');
        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $count = 0;
            foreach ($sheetData as $key => $row) {
                if ($key == 0) continue; 
                if (!empty($row[0])) {
                    $this->userModel->insert([
                        'username'     => $row[0],
                        'password'     => password_hash($row[1], PASSWORD_DEFAULT),
                        'nama_lengkap' => $row[2],
                        'level'        => $row[3],
                        'foto'         => 'default-profile.png'
                    ]);
                    $count++;
                }
            }
            session()->setFlashdata('success', $count . ' User berhasil diimport');
        } else {
            session()->setFlashdata('error', 'File tidak valid');
        }
        return redirect()->to(base_url('admin/users'));
    }
}