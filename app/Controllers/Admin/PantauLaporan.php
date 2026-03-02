<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Staff\AuditModel;
use App\Models\Common\UserModel;

class PantauLaporan extends BaseController
{
    public function index()
    {
        $auditModel = new AuditModel();
        $userModel = new UserModel();

        $staff_id = $this->request->getGet('staff_id');
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        $builder = $auditModel->select('audit.*, users.nama_lengkap as nama_staff, master_data.nama_area')
                              ->join('users', 'users.id = audit.staff_id')
                              ->join('master_data', 'master_data.id = audit.area_id');

        if ($staff_id) {
            $builder->where('audit.staff_id', $staff_id);
        }
        if ($start_date && $end_date) {
            $builder->where('audit.tanggal_audit >=', $start_date)
                    ->where('audit.tanggal_audit <=', $end_date);
        }

        $data = [
            'title'   => 'Pantau Laporan Audit',
            'laporan' => $builder->orderBy('audit.created_at', 'DESC')->findAll(),
            'staffs'  => $userModel->where('level', 'STAFF')->findAll()
        ];

        return view('admin/pantau_laporan/index', $data);
    }

    public function detail($id)
    {
        $auditModel = new AuditModel();
        
        $data = [
            'title'   => 'Detail Laporan',
            'laporan' => $auditModel->select('audit.*, users.nama_lengkap as nama_staff, master_data.nama_area')
                                    ->join('users', 'users.id = audit.staff_id')
                                    ->join('master_data', 'master_data.id = audit.area_id')
                                    ->find($id)
        ];

        return view('admin/pantau_laporan/detail', $data);
    }
}