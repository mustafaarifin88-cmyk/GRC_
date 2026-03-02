<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\Staff\AuditModel;

class ProgresLaporan extends BaseController
{
    public function index()
    {
        $auditModel = new AuditModel();
        
        $data = [
            'title'   => 'Progres Laporan',
            'laporan' => $auditModel->select('audit.*, master_data.nama_area')
                                    ->join('master_data', 'master_data.id = audit.area_id')
                                    ->where('audit.staff_id', $this->session->get('id'))
                                    ->orderBy('audit.created_at', 'DESC')
                                    ->findAll()
        ];
        
        return view('staff/progres/index', $data);
    }
}