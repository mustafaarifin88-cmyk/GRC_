<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class PantauProgres extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');
        $data = [
            'title' => 'Pantau Progres Laporan',
            'da_audit'      => (new \App\Models\FormsAudit\AuditBondModel())->where('user_id', $userId)->findAll(),
            'da_compliance' => (new \App\Models\FormsAudit\ComplianceBondModel())->where('user_id', $userId)->findAll(),
            'da_risk'       => (new \App\Models\FormsAudit\RiskBondModel())->where('user_id', $userId)->findAll(),
            'da_insiden'    => (new \App\Models\FormsAudit\InsidenModel())->where('user_id', $userId)->findAll(),
            'igrc_audit'       => (new \App\Models\FormsInternalGRC\IntAuditBondModel())->where('user_id', $userId)->findAll(),
            'igrc_compliance'  => (new \App\Models\FormsInternalGRC\IntComplianceBondModel())->where('user_id', $userId)->findAll(),
            'igrc_risk'        => (new \App\Models\FormsInternalGRC\IntRiskBondModel())->where('user_id', $userId)->findAll(),
            'igrc_fraud'       => (new \App\Models\FormsInternalGRC\IntFraudBondModel())->where('user_id', $userId)->findAll(),
            'igrc_incident'    => (new \App\Models\FormsInternalGRC\IntIncidentBondModel())->where('user_id', $userId)->findAll(),
            'igrc_cyber'       => (new \App\Models\FormsInternalGRC\IntCyberBondModel())->where('user_id', $userId)->findAll(),
            'igrc_third_party' => (new \App\Models\FormsInternalGRC\IntThirdPartyBondModel())->where('user_id', $userId)->findAll(),
            'igrc_continuity'  => (new \App\Models\FormsInternalGRC\IntContinuityBondModel())->where('user_id', $userId)->findAll(),
            'igrc_control'     => (new \App\Models\FormsInternalGRC\IntControlBondModel())->where('user_id', $userId)->findAll(),
        ];
        return view('staff/pantau_progres/index', $data);
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
            case 'da_audit': return new \App\Models\FormsAudit\AuditBondModel();
            case 'da_compliance': return new \App\Models\FormsAudit\ComplianceBondModel();
            case 'da_risk': return new \App\Models\FormsAudit\RiskBondModel();
            case 'da_insiden': return new \App\Models\FormsAudit\InsidenModel();
            case 'igrc_audit': return new \App\Models\FormsInternalGRC\IntAuditBondModel();
            case 'igrc_compliance': return new \App\Models\FormsInternalGRC\IntComplianceBondModel();
            case 'igrc_risk': return new \App\Models\FormsInternalGRC\IntRiskBondModel();
            case 'igrc_fraud': return new \App\Models\FormsInternalGRC\IntFraudBondModel();
            case 'igrc_incident': return new \App\Models\FormsInternalGRC\IntIncidentBondModel();
            case 'igrc_cyber': return new \App\Models\FormsInternalGRC\IntCyberBondModel();
            case 'igrc_third_party': return new \App\Models\FormsInternalGRC\IntThirdPartyBondModel();
            case 'igrc_continuity': return new \App\Models\FormsInternalGRC\IntContinuityBondModel();
            case 'igrc_control': return new \App\Models\FormsInternalGRC\IntControlBondModel();
            default: return null;
        }
    }
}