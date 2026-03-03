<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 1. Hitung Total User
        $total_users = $db->table('tb_users')->countAllResults();
        
        // Daftar semua tabel laporan GRC
        $tables = [
            'da_audit_bond', 'da_compliance_bond', 'da_risk_bond', 'da_formulir_insiden',
            'igrc_audit_bond', 'igrc_compliance_bond', 'igrc_risk_bond', 'igrc_fraud_bond',
            'igrc_incident_bond', 'igrc_cyber_bond', 'igrc_third_party_bond', 
            'igrc_continuity_bond', 'igrc_control_bond'
        ];
        
        $total_laporan = 0;
        $menunggu_approval = 0;
        
        // 2 & 3. Hitung Total Laporan & Menunggu Approval (Belum final di Pimpinan Tinggi & tidak ditolak)
        foreach ($tables as $table) {
            $total_laporan += $db->table($table)->countAllResults();
            $menunggu_approval += $db->table($table)
                                     ->whereNotIn('status', ['approve_pt', 'ditolak'])
                                     ->countAllResults();
        }
        
        // 4. Hitung khusus laporan dengan Risiko Tinggi
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
}