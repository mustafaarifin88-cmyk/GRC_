<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LeaderFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $allowedLevels = ['PIMPINAN TINGGI', 'MANAGERIAL', 'SUPERVISOR', 'KEPALA UNIT'];
        
        if (!in_array(session()->get('level'), $allowedLevels)) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak memiliki otorisasi Pimpinan.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}