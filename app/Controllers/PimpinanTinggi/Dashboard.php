<?php

namespace App\Controllers\PimpinanTinggi;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Pimpinan Tinggi'
        ];
        return view('pimpinan_tinggi/dashboard/index', $data);
    }
}