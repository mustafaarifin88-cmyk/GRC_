<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}