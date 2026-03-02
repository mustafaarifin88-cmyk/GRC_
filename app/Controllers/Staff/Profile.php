<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\Common\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $userId = $this->session->get('id');

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap')
            ];

            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $userLama = $userModel->find($userId);
                if ($userLama['foto'] != 'default_user.png' && file_exists('uploads/users/' . $userLama['foto'])) {
                    unlink('uploads/users/' . $userLama['foto']);
                }
                $namaFoto = $foto->getRandomName();
                $foto->move('uploads/users', $namaFoto);
                $data['foto'] = $namaFoto;
                
                $this->session->set('foto', $namaFoto);
            }

            $userModel->update($userId, $data);
            $this->session->set('nama_lengkap', $data['nama_lengkap']);

            return redirect()->to('/staff/profile')->with('success', 'Profil berhasil diupdate');
        }

        $data = [
            'title' => 'Edit Profil',
            'user'  => $userModel->find($userId)
        ];

        return view('shared/profile/edit', $data);
    }
}