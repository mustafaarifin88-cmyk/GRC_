<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Common\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Users extends BaseController
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
        return view('admin/users/index', $data);
    }

    public function create()
    {
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $foto = $this->request->getFile('foto');
        $namaFoto = 'default_user.png';

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/users', $namaFoto);
        }

        $this->userModel->insert([
            'username'     => $this->request->getPost('username'),
            'password'     => $password,
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'level'        => $this->request->getPost('level'),
            'foto'         => $namaFoto
        ]);

        return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'level'        => $this->request->getPost('level'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $userLama = $this->userModel->find($id);
            if ($userLama['foto'] != 'default_user.png' && file_exists('uploads/users/' . $userLama['foto'])) {
                unlink('uploads/users/' . $userLama['foto']);
            }
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/users', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if ($user['foto'] != 'default_user.png' && file_exists('uploads/users/' . $user['foto'])) {
            unlink('uploads/users/' . $user['foto']);
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus');
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            foreach ($sheetData as $key => $row) {
                if ($key == 0) continue;
                if (!empty($row[0])) {
                    $this->userModel->insert([
                        'username'     => $row[0],
                        'password'     => password_hash($row[1], PASSWORD_DEFAULT),
                        'nama_lengkap' => $row[2],
                        'level'        => $row[3],
                        'foto'         => 'default_user.png'
                    ]);
                }
            }
            return redirect()->to('/admin/users')->with('success', 'Data berhasil diimport');
        }
        return redirect()->to('/admin/users')->with('error', 'Gagal upload file');
    }
}