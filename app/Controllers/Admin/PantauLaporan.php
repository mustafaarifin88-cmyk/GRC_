<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\HierarchyModel;

class PantauLaporan extends BaseController
{
    protected $userModel;
    protected $hierarchyModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->hierarchyModel = new HierarchyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pantau Laporan Staff',
            'pimpinanTinggi' => $this->userModel->where('level', 'PIMPINAN TINGGI')->findAll()
        ];
        
        $staffId = $this->request->getGet('staff_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        
        $data['laporan'] = []; 

        if ($staffId && $startDate && $endDate) {
            $data['laporan'] = [];
        }

        return view('admin/pantau_laporan/index', $data);
    }
    
    public function get_hierarchy_down()
    {
        $atasanId = $this->request->getPost('atasan_id');
        $bawahan = $this->hierarchyModel
            ->select('tb_users.id, tb_users.nama_lengkap, tb_users.level')
            ->join('tb_users', 'tb_users.id = tb_user_hierarchy.bawahan_id')
            ->where('tb_user_hierarchy.atasan_id', $atasanId)
            ->findAll();
            
        return $this->response->setJSON($bawahan);
    }
}