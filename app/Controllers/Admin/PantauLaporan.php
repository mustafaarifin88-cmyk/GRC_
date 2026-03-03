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
        
        $laporan = []; 

        if ($staffId && $startDate && $endDate) {
            $db = \Config\Database::connect();
            $tables = [
                'da_audit_bond' => 'Data Audit: Audit Bond',
                'da_compliance_bond' => 'Data Audit: Compliance Bond',
                'da_risk_bond' => 'Data Audit: Risk Bond',
                'da_formulir_insiden' => 'Data Audit: Formulir Insiden',
                'igrc_audit_bond' => 'Int GRC: Audit Bond',
                'igrc_compliance_bond' => 'Int GRC: Compliance Bond',
                'igrc_risk_bond' => 'Int GRC: Risk Bond',
                'igrc_fraud_bond' => 'Int GRC: Fraud Bond',
                'igrc_incident_bond' => 'Int GRC: Incident Bond',
                'igrc_cyber_bond' => 'Int GRC: Cyber Bond',
                'igrc_third_party_bond' => 'Int GRC: Third Party Bond',
                'igrc_continuity_bond' => 'Int GRC: Continuity Bond',
                'igrc_control_bond' => 'Int GRC: Control Bond'
            ];

            foreach ($tables as $table => $label) {
                $query = $db->table($table)
                    ->where('user_id', $staffId)
                    ->where('created_at >=', $startDate . ' 00:00:00')
                    ->where('created_at <=', $endDate . ' 23:59:59')
                    ->get()->getResultArray();
                
                foreach ($query as $row) {
                    $judul = $row['judul'] ?? $row['no_lisensi'] ?? $row['nama_peraturan'] ?? $row['aset'] ?? $row['nama_perusahaan'] ?? $row['bia_proses'] ?? $row['nama_kontrol'] ?? 'Tanpa Judul';
                    $laporan[] = [
                        'id' => $row['id'],
                        'judul' => $judul,
                        'tanggal' => $row['created_at'],
                        'jenis_form' => $label,
                        'status' => $row['status']
                    ];
                }
            }
            
            usort($laporan, function($a, $b) {
                return strtotime($b['tanggal']) - strtotime($a['tanggal']);
            });
        }

        $data['laporan'] = $laporan;
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