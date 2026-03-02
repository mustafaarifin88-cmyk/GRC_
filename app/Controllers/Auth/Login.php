<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Common\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if ($this->session->get('logged_in')) {
            return $this->redirectBasedOnLevel($this->session->get('level'));
        }
        return view('auth/login');
    }

    public function process()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify((string)$password, $user['password'])) {
            $sessionData = [
                'id'           => $user['id'],
                'username'     => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'level'        => $user['level'],
                'foto'         => $user['foto'],
                'logged_in'    => true
            ];
            $this->session->set($sessionData);
            
            return $this->redirectBasedOnLevel($user['level']);
        }

        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    private function redirectBasedOnLevel($level)
    {
        switch ($level) {
            case 'ADMIN': return redirect()->to('/admin/dashboard');
            case 'STAFF': return redirect()->to('/staff/dashboard');
            case 'KEPALA UNIT': return redirect()->to('/kepala_unit/dashboard');
            case 'SUPERVISOR': return redirect()->to('/supervisor/dashboard');
            case 'MANAGERIAL': return redirect()->to('/managerial/dashboard');
            case 'PIMPINAN TINGGI': return redirect()->to('/pimpinan_tinggi/dashboard');
            default: return redirect()->to('/login');
        }
    }
}