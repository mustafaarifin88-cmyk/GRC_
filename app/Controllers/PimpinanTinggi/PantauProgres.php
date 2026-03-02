<?php

namespace App\Controllers\PimpinanTinggi;

use App\Controllers\BaseController;

class PantauProgres extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');
        
        $auditModel = new \App\Models\FormsAudit\AuditBondModel();
        $complianceModel = new \App\Models\FormsAudit\ComplianceBondModel();
        $riskModel = new \App\Models\FormsAudit\RiskBondModel();
        $insidenModel = new \App\Models\FormsAudit\InsidenModel();

        $data = [
            'title'      => 'Pantau Progres Laporan',
            'audit'      => $auditModel->where('user_id', $userId)->findAll(),
            'compliance' => $complianceModel->where('user_id', $userId)->findAll(),
            'risk'       => $riskModel->where('user_id', $userId)->findAll(),
            'insiden'    => $insidenModel->where('user_id', $userId)->findAll(),
        ];
        return view('pimpinan_tinggi/pantau_progres/index', $data);
    }

    public function detail_alasan($type, $id)
    {
        $model = $this->getModelByType($type);

        if ($model) {
            $laporan = $model->find($id);
            return $this->response->setJSON(['alasan_tolak' => $laporan['alasan_tolak'] ?? 'Tidak ada alasan.']);
        }
        return $this->response->setJSON(['alasan_tolak' => 'Data tidak ditemukan.']);
    }

    private function getModelByType($type)
    {
        switch ($type) {
            case 'audit': return new \App\Models\FormsAudit\AuditBondModel();
            case 'compliance': return new \App\Models\FormsAudit\ComplianceBondModel();
            case 'risk': return new \App\Models\FormsAudit\RiskBondModel();
            case 'insiden': return new \App\Models\FormsAudit\InsidenModel();
            default: return null;
        }
    }
}