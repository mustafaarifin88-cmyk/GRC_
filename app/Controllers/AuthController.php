<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnLevel(session()->get('level'));
        }
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id'           => $data['id'],
                    'username'     => $data['username'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'level'        => $data['level'],
                    'foto'         => $data['foto'],
                    'logged_in'    => TRUE
                ];
                $session->set($ses_data);
                return $this->redirectBasedOnLevel($data['level']);
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    private function redirectBasedOnLevel($level)
    {
        switch ($level) {
            case 'ADMIN': return redirect()->to(base_url('admin/dashboard'));
            case 'PIMPINAN TINGGI': return redirect()->to(base_url('pimpinan/dashboard'));
            case 'MANAGERIAL': return redirect()->to(base_url('managerial/dashboard'));
            case 'SUPERVISOR': return redirect()->to(base_url('supervisor/dashboard'));
            case 'KEPALA UNIT': return redirect()->to(base_url('kepalaunit/dashboard'));
            case 'STAFF': return redirect()->to(base_url('staff/dashboard'));
            default: return redirect()->to(base_url('login'));
        }
    }
}