<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $total_users = $db->table('tb_users')->countAllResults();
        
        $tables = [
            'da_audit_bond', 'da_compliance_bond', 'da_risk_bond', 'da_formulir_insiden',
            'igrc_audit_bond', 'igrc_compliance_bond', 'igrc_risk_bond', 'igrc_fraud_bond',
            'igrc_incident_bond', 'igrc_cyber_bond', 'igrc_third_party_bond', 
            'igrc_continuity_bond', 'igrc_control_bond'
        ];
        
        $total_laporan = 0;
        $menunggu_approval = 0;
        
        foreach ($tables as $table) {
            $total_laporan += $db->table($table)->countAllResults();
            $menunggu_approval += $db->table($table)
                                     ->whereNotIn('status', ['approve_pt', 'ditolak'])
                                     ->countAllResults();
        }
        
        $risiko_tinggi = 0;
        $risiko_tinggi += $db->table('da_risk_bond')->where('tingkat_risiko', 'Tinggi')->countAllResults();
        $risiko_tinggi += $db->table('igrc_risk_bond')->where('tingkat', 'Tinggi')->countAllResults();

        $data = [
            'title'             => 'Dashboard Admin',
            'total_users'       => $total_users,
            'total_laporan'     => $total_laporan,
            'menunggu_approval' => $menunggu_approval,
            'risiko_tinggi'     => $risiko_tinggi
        ];
        
        return view('admin/dashboard', $data);
    }

    public function detail($type)
    {
        $db = \Config\Database::connect();
        $tables = [
            'da_audit_bond' => 'Data Audit: Audit Bond', 'da_compliance_bond' => 'Data Audit: Compliance Bond', 
            'da_risk_bond' => 'Data Audit: Risk Bond', 'da_formulir_insiden' => 'Data Audit: Formulir Insiden',
            'igrc_audit_bond' => 'Int GRC: Audit Bond', 'igrc_compliance_bond' => 'Int GRC: Compliance Bond', 
            'igrc_risk_bond' => 'Int GRC: Risk Bond', 'igrc_fraud_bond' => 'Int GRC: Fraud Bond',
            'igrc_incident_bond' => 'Int GRC: Incident Bond', 'igrc_cyber_bond' => 'Int GRC: Cyber Bond', 
            'igrc_third_party_bond' => 'Int GRC: Third Party Bond', 'igrc_continuity_bond' => 'Int GRC: Continuity Bond', 
            'igrc_control_bond' => 'Int GRC: Control Bond'
        ];
        
        $dataList = [];
        $title = '';

        if ($type == 'menunggu_approval') {
            $title = "Detail Seluruh Laporan Menunggu Approval";
            foreach ($tables as $table => $label) {
                $query = $db->table($table)->select("$table.*, tb_users.nama_lengkap")->join('tb_users', "tb_users.id = $table.user_id")->whereNotIn("$table.status", ['approve_pt', 'ditolak'])->get()->getResultArray();
                foreach ($query as $row) {
                    $judul = $row['judul'] ?? $row['no_lisensi'] ?? $row['nama_peraturan'] ?? $row['aset'] ?? $row['nama_perusahaan'] ?? $row['bia_proses'] ?? $row['nama_kontrol'] ?? 'Tanpa Judul';
                    $dataList[] = ['staff' => $row['nama_lengkap'], 'judul' => $judul, 'jenis' => $label, 'tanggal' => $row['created_at'], 'status' => $row['status']];
                }
            }
        } elseif ($type == 'risiko_tinggi') {
            $title = "Detail Laporan Status Risiko Tinggi";
            $query1 = $db->table('da_risk_bond')->select("da_risk_bond.*, tb_users.nama_lengkap")->join('tb_users', "tb_users.id = da_risk_bond.user_id")->where('tingkat_risiko', 'Tinggi')->get()->getResultArray();
            foreach($query1 as $row) { 
                $dataList[] = ['staff' => $row['nama_lengkap'], 'judul' => $row['judul'], 'jenis' => 'Data Audit: Risk Bond', 'tanggal' => $row['created_at'], 'status' => $row['status']]; 
            }
            $query2 = $db->table('igrc_risk_bond')->select("igrc_risk_bond.*, tb_users.nama_lengkap")->join('tb_users', "tb_users.id = igrc_risk_bond.user_id")->where('tingkat', 'Tinggi')->get()->getResultArray();
            foreach($query2 as $row) { 
                $dataList[] = ['staff' => $row['nama_lengkap'], 'judul' => $row['judul'], 'jenis' => 'Int GRC: Risk Bond', 'tanggal' => $row['created_at'], 'status' => $row['status']]; 
            }
        } elseif ($type == 'total_laporan') {
            $title = "Semua Laporan Masuk";
            foreach ($tables as $table => $label) {
                $query = $db->table($table)->select("$table.*, tb_users.nama_lengkap")->join('tb_users', "tb_users.id = $table.user_id")->get()->getResultArray();
                foreach ($query as $row) {
                    $judul = $row['judul'] ?? $row['no_lisensi'] ?? $row['nama_peraturan'] ?? $row['aset'] ?? $row['nama_perusahaan'] ?? $row['bia_proses'] ?? $row['nama_kontrol'] ?? 'Tanpa Judul';
                    $dataList[] = ['staff' => $row['nama_lengkap'], 'judul' => $judul, 'jenis' => $label, 'tanggal' => $row['created_at'], 'status' => $row['status']];
                }
            }
        }

        usort($dataList, function($a, $b) { 
            return strtotime($b['tanggal']) - strtotime($a['tanggal']); 
        });

        return view('admin/detail_dashboard', ['title' => $title, 'dataList' => $dataList]);
    }
}