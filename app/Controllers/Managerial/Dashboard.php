<?php

namespace App\Controllers\Managerial;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Managerial'
        ];
        return view('managerial/dashboard', $data);
    }
}