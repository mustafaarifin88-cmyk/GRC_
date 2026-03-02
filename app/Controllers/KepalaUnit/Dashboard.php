<?php

namespace App\Controllers\KepalaUnit;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Kepala Unit'
        ];
        return view('kepala_unit/dashboard/index', $data);
    }
}