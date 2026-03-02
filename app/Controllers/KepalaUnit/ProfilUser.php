<?php

namespace App\Controllers\KepalaUnit;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfilUser extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Edit Profil Saya',
            'user'  => $this->userModel->find(session()->get('id'))
        ];
        return view('kepala_unit/profil_user/edit', $data);
    }

    public function update()
    {
        $id = session()->get('id');
        $user = $this->userModel->find($id);
        $fileFoto = $this->request->getFile('foto');
        $password = $this->request->getPost('password');

        $dataUpdate = [];

        if (!empty($password)) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/profiles', $namaFoto);
            $dataUpdate['foto'] = $namaFoto;

            if ($user['foto'] != 'default-profile.png' && file_exists(FCPATH . 'uploads/profiles/' . $user['foto'])) {
                unlink(FCPATH . 'uploads/profiles/' . $user['foto']);
            }
            session()->set('foto', $namaFoto);
        }

        if (!empty($dataUpdate)) {
            $this->userModel->update($id, $dataUpdate);
            session()->setFlashdata('success', 'Profil berhasil diupdate');
        }

        return redirect()->to(base_url('kepalaunit/profil'));
    }
}