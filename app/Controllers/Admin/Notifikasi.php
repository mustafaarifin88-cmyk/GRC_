<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NotificationModel;
use App\Models\UserModel;

class Notifikasi extends BaseController
{
    protected $notifModel;
    protected $userModel;

    public function __construct()
    {
        $this->notifModel = new NotificationModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kirim Notifikasi',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/notifikasi/index', $data);
    }

    public function send()
    {
        $userIds = $this->request->getPost('user_id');
        $judul = $this->request->getPost('judul');
        $pesan = $this->request->getPost('pesan');

        if (in_array('all', $userIds)) {
            $allUsers = $this->userModel->findAll();
            foreach ($allUsers as $user) {
                $this->notifModel->insert([
                    'user_id' => $user['id'],
                    'judul'   => $judul,
                    'pesan'   => $pesan
                ]);
            }
        } else {
            foreach ($userIds as $userId) {
                $this->notifModel->insert([
                    'user_id' => $userId,
                    'judul'   => $judul,
                    'pesan'   => $pesan
                ]);
            }
        }

        session()->setFlashdata('success', 'Notifikasi berhasil dikirim');
        return redirect()->to(base_url('admin/notifikasi'));
    }
}