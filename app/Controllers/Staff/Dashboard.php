<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Staff'
        ];
        return view('staff/dashboard/index', $data);
    }
}