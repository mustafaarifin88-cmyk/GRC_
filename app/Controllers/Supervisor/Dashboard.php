<?php

namespace App\Controllers\Supervisor;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Supervisor'
        ];
        return view('supervisor/dashboard/index', $data);
    }
}